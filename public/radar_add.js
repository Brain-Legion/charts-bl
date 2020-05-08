

function createBiwgWheelChartAdd (config) {
	console.log(config);
	var defaultOpacity = 0,
	    multiselect    = config.multiselect || true,
	    active_color   = config.active_color || "#000",
	    data_object    = config.data_object,
	    levelNames     = config.levelNames,
	    sublevelNames  = config.sublevelNames,
	    levels         = config.levels,
	    containerID    = config.containerID;

	function fillOpacity (value) {
		if (value === 0)
			return defaultOpacity;
		return Math.ceil(value / 100) / 10;
	}

	if (data_object) {
		// am4core.useTheme(am4themes_animated);

		var chart = am4core.create(containerID, am4charts.RadarChart);

		chart.height = 800;
		chart.data   = data_object;

		chart.padding(5, 25, 15, 30);
		chart.height = 800;

		chart.hiddenState.properties.opacity = 0;

		chart.startAngle = -180;
		chart.endAngle   = -180 + 360;

		chart.radius      = am4core.percent(80);
		chart.innerRadius = am4core.percent(15);

		var label        = chart.createChild(am4core.Label);
		label.exportable = false;

		var categoryAxis                 = chart.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "competence";

		categoryAxis.cursorTooltipEnabled = true;

		var categoryAxisRenderer = categoryAxis.renderer;
		var categoryAxisLabel    = categoryAxisRenderer.labels.template;

		categoryAxisRenderer.fontSize                          = 12;
		categoryAxisRenderer.grid.template.strokeWidth         = 0;
		categoryAxisRenderer.grid.template.interactionsEnabled = false;
		categoryAxisRenderer.ticks.template.disabled           = true;
		categoryAxisRenderer.axisFills.template.disabled       = true;
		categoryAxisRenderer.line.disabled                     = true;
		categoryAxisRenderer.tooltipLocation                   = 0.5;

		categoryAxisRenderer.cellStartLocation = -0.115;
		categoryAxisRenderer.cellEndLocation   = 1.115;

		categoryAxisLabel.location         = 0.5;
		categoryAxisLabel.radius           = -5;
		categoryAxisLabel.relativeRotation = 90;

		categoryAxis.mouseEnabled                            = false;
		categoryAxis.tooltip.defaultState.properties.opacity = 0;

		var valueAxis         = chart.yAxes.push(new am4charts.ValueAxis());
		var valueAxisRenderer = valueAxis.renderer;

		valueAxisRenderer.axisFills.template.disabled = true;
		valueAxisRenderer.ticks.template.disabled     = true;
		valueAxisRenderer.grid.template.strokeOpacity = 0;
		valueAxisRenderer.labels.template.disabled    = true;
//
		valueAxis.min                                 = 0;
		valueAxis.max                                 = 1250;
		valueAxis.strictMinMax                        = false;
//
// 	valueAxis.tooltip.defaultState.properties.opacity = 0;
// 	valueAxis.tooltip.disabled                        = true;
// 	valueAxis.cursorTooltipEnabled                    = false;
// 	valueAxis.zIndex                                  = 10;

// Создание кольцевых сектотров на основе data_object
		let series_level_array = {
			level_1 : [],
			level_2 : [],
			level_3 : []
		};
		let selected_id        = [];
		let selected_element   = [];
		let selected_color     = [];
		let sablevels_quantity = [ 0, 7, 5, 7 ];
		for (let level = 3; level > 0; level--) {

			for (let sublevel = sablevels_quantity[ level ]; sublevel > 0; sublevel--) {
				let index                                         = level + "_" + sublevel;
				var series                                        = chart.series.push(new am4charts.RadarColumnSeries());
				series.name                                       = 'Level_' + index;
				series.stacked                                    = true;
				series.columns.template.radarColumn.strokeOpacity = 1;
				series.columns.template.radarColumn.configField   = "config" + level;
				series.columns.template.tooltipText               = "{name}";
				series.dataFields.categoryX                       = "competence";
				series.dataFields.valueY                          = 'level_' + index;
				series.sequencedInterpolation                     = true;

				series.columns.template.adapter.add("fillOpacity", function (fill, target) {
					if (typeof levels[ index ] !== 'undefined')
						return fillOpacity(levels[ index ][ target.dataItem.index ]);
					else
						return defaultOpacity;
				});

				series.columns.template.adapter.add("fill", function (fill, target) {
					return target.column.fill;
				});

				series.columns.template.adapter.add("tooltipText", function (text, target) {
					var r = (level == 1) ? sublevelNames[ target.dataItem.dataContext.type + "_" + index ] : sublevelNames[ index ];
					// if (typeof levels[ index ] !== 'undefined')
					// 	r += ": " + levels[ index ][ target.dataItem.index ];
					return r;
				});

				series.columns.template.events.on("hit", function (ev) {
					let levelEl = $('#bigwheel-level').clone();
					let dEl     = $('#bigwheel-level-container');

					if (selected_element.indexOf(ev.target) == -1) {
						if (selected_id.length < 3) {
							if (!multiselect) {
								selected_element.forEach((element, i) => {
									let key_split = selected_id[ i ].split('_');
									element._element.node.firstChild.setAttribute('fill', selected_color[ selected_element.indexOf(element) ]);
									element.fillOpacity = fillOpacity(levels[ key_split[ 0 ] + '_' + key_split[ 1 ] ][ key_split[ 2 ] ]);
								});
								selected_element = [];
								selected_id      = [];
								selected_color   = [];
							}

							ev.target.fillOpacity = 1;
							selected_id.push(index + '_' + ev.target.dataItem.index);
							selected_element.push(ev.target);
							selected_color.push(ev.target._element.node.firstChild.getAttribute('fill'));
							ev.target._element.node.firstChild.setAttribute('fill', active_color);
							selected_all = selected_id;

							// Block info.
							let sector      = ev.target.dataItem.index;
							let key_split   = index.split('_');
							let level       = key_split[ 0 ];
							let context     = ev.target.dataItem.dataContext;
							let type        = context.type;
							let sublevel    = key_split[ 1 ];
							let sublevelKey = level + '_' + sublevel;
							if (level == 1)
								sublevelKey = type + '_' + sublevelKey;

							levelEl.attr('id', index + '_' + ev.target.dataItem.index);
							levelEl.find('.title').html(levelNames[ level ]);
							levelEl.find('.subtitle').html(sublevelNames[ sublevelKey ]);
							levelEl.find('.competence').html(context.title);

							levelEl.removeClass('d-none');
							dEl.append(levelEl);
						}

					} else {
						ev.target.fillOpacity = fillOpacity(levels[ index ][ ev.target.dataItem.index ]);
						ev.target._element.node.firstChild.setAttribute('fill', selected_color[ selected_element.indexOf(ev.target) ]);
						selected_element.splice(selected_element.indexOf(ev.target), 1);
						selected_id.splice(selected_element.indexOf(ev.target), 1);
						selected_color.splice(selected_element.indexOf(ev.target), 1);
						$('#' + index + '_' + ev.target.dataItem.index).remove();

					}
				}, this);

				series_level_array[ 'level_' + level ][ sublevel ] = series;

			}
			var series_gap                                        = chart.series.push(new am4charts.RadarColumnSeries());
			series_gap.stacked                                    = true;
			series_gap.columns.template.radarColumn.strokeOpacity = 0;
			series_gap.columns.template.radarColumn.configField   = "level_gap_config";
			series_gap.dataFields.categoryX                       = "competence";
			series_gap.dataFields.valueY                          = "level_gap";
			series_gap.sequencedInterpolation                     = true;
			series_gap.sequencedInterpolationDelay                = 10;
		}
		chart.seriesContainer.zIndex = -1;

	} else {
		console.error('data_object => undefined')
	}
}