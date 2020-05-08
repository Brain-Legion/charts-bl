




// функция чарта открывается, параметр компетенций передается снизу от result ебаного
function prepareBigwheelChartConfigCompetence (competences) {
	
	function fillOpacity (value) {
		if (value === 0)
			return defaultOpacity;
		return Math.ceil(value / 100) / 10;
	}

	
	// цвета хули
	var colors = [
		{
			type   : 1,
			fill   : am4core.color("rgb(252,232,233)"),
			stroke : am4core.color("rgb(247,196,198)"),
			active : am4core.color("rgb(250,0,17)")
		},
		{
			type   : 2,
			fill   : am4core.color("rgb(254,241,226)"),
			stroke : am4core.color("rgb(253,217,178)"),
			active : am4core.color("rgb(255,157,20)")
		},
		{
			type   : 3,
			fill   : am4core.color("rgb(243,244,241)"),
			stroke : am4core.color("rgb(225,230,222)"),
			active : am4core.color("rgb(165,196,117)")
		},
		{
			type   : 4,
			fill   : am4core.color("rgb(227,234,242)"),
			stroke : am4core.color("rgb(183,200,220)"),
			active : am4core.color("rgb(28,121,195)")
		}
	];


	// выбирает цвет из массива colors в зависимости от типа
	function getColor (type) {
		for (var i in colors) {
			if (colors[ i ].type == type)
				return colors[ i ];
		}
	}
	

	var data = [];
	for (var i in competences) {
		var competence = competences[ i ];
		var color = getColor(competence.type);
		var item = {
			competence : competence.label, 
			title      : competence.title, 
			type       : competence.type,
			config1    : {
				fill   : color.active,
				stroke : color.stroke
			},
			config2    : {
				fill   : color.active,
				stroke : color.stroke
			},
			config3    : {
				fill   : color.active,
				stroke : color.stroke
			}
		};
		// level 3
		for (var k = 7; k >= 1; k--) {
			var name = 'level_3_' + k;
			item[ name ] = 60;
			// level 3
			if (competence.type == 1) {
				item.config3.fillOpacity = 0;
				item.config3.strokeOpacity = 0;
			} else {

			}
		}

		// gap
		item.level_gap = 30;
		item.level_gap_config = {
			fill : am4core.color('#fff')
		};

		// level 2
		for (var k = 5; k >= 1; k--) {
			var name = 'level_2_' + k;
			item[ name ] = 84;
		}

		// level 1
		for (var k = 7; k >= 1; k--) {
			var name = 'level_1_' + k;
			if (competence.type == 1) {
				item[ name ] = (k > 3) ? 0 : 140;
			} else if (competence.type == 2) {
				item[ name ] = (k > 4) ? 0 : 105;
			} else {
				item[ name ] = 60;
			}
		}

		data.push(item);
	}
	return data;
	console.log('prepareBigwheelChartConfigCompetence');
}


// config
function prepareBigwheelChartConfig(result) {
	console.log(result);


	var chartData = result.data;
	var chartDataClear = result.dataClear;
	var levelNames = result.levelNames;
	var sublevelNames = result.sublevelNames;
	var competences = result.competences;
	var competencesClear = result.competencesClear;
	var files = result.files;
	var filesClear = result.filesClear;
	var events = result.events;

	
	var defaultOpacity = 0;
	var data = prepareBigwheelChartConfigCompetence(competences);
	var dataClear = prepareBigwheelChartConfigCompetence(competencesClear);
	
	return {
		mutliselect       : false,
		active_color      : 'cyan',
		data_object       : data,
		data_object_clear : dataClear,
		levelNames        : levelNames,
		sublevelNames     : sublevelNames,
		levels            : chartData,
		levelsClear       : chartDataClear,
		files             : files,
		filesClear        : filesClear,
		events            : events
	};
}

function createBigWheelChart (config, clear) {
	console.log('createBigWheelChart');
	if (!clear) {
		var defaultOpacity = 0,
			multiselect = config.multiselect || false,
			active_color = config.active_color || "#000",
			data_object = config.data_object
			levelNames = config.levelNames,
			sublevelNames = config.sublevelNames,
			levels = config.levels,
			files = config.files,
			events = config.events,
			containerID = config.containerID;
	} else {
		var defaultOpacity = 0
			multiselect = config.multiselect || false,
			active_color = config.active_color || "#000",
			data_object = config.data_object_clear
			levelNames = config.levelNames,
			sublevelNames = config.sublevelNames,
			levels = config.levelsClear,
			files = config.filesClear,
			events = config.events,
			containerID = config.containerID;
	}

	function fillOpacity (value) {
		if (value === 0)
			return defaultOpacity;
		return Math.ceil(value / 100) / 10;
	}

	if (!data_object) {
		console.error('data_object => undefined');
		return null;
	}

	// am4core.useTheme(am4themes_animated);

	var chart = am4core.create(config.containerID, am4charts.RadarChart);

	chart.chartContainer.events.on('ready', function () {
		loadNextChart('bigwheel');
	});
	if (config.readyCallback) {
		chart.events.on('ready', config.readyCallback);
	}

	chart.height = 800;
	chart.data = data_object;

	chart.padding(5, 25, 15, 30);
	chart.height = 800;

	chart.hiddenState.properties.opacity = 0;

	chart.startAngle = -180;
	chart.endAngle = -180 + 360;

	chart.radius = am4core.percent(80);
	chart.innerRadius = am4core.percent(15);

	var label = chart.createChild(am4core.Label);
	label.exportable = false;


	// создается chart
	var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
	categoryAxis.dataFields.category = "competence";

	categoryAxis.cursorTooltipEnabled = true;

	var categoryAxisRenderer = categoryAxis.renderer;
	var categoryAxisLabel = categoryAxisRenderer.labels.template;

	categoryAxisRenderer.fontSize = 12;
	categoryAxisRenderer.grid.template.strokeWidth = 0;
	categoryAxisRenderer.grid.template.interactionsEnabled = false;
	categoryAxisRenderer.ticks.template.disabled = true;
	categoryAxisRenderer.axisFills.template.disabled = true;
	categoryAxisRenderer.line.disabled = true;
	categoryAxisRenderer.tooltipLocation = 0.5;

	categoryAxisRenderer.cellStartLocation = -0.115;
	categoryAxisRenderer.cellEndLocation = 1.115;

	categoryAxisLabel.location = 0.5;
	categoryAxisLabel.radius = -5;
	categoryAxisLabel.relativeRotation = 90;

	categoryAxis.mouseEnabled = false;
	categoryAxis.tooltip.defaultState.properties.opacity = 0;

	var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
	var valueAxisRenderer = valueAxis.renderer;

	valueAxisRenderer.axisFills.template.disabled = true;
	valueAxisRenderer.ticks.template.disabled = true;
	valueAxisRenderer.grid.template.strokeOpacity = 0;
	valueAxisRenderer.labels.template.disabled = true;
//
	valueAxis.min = 0;
	valueAxis.max = 1250;
	valueAxis.strictMinMax = false;


//
	// valueAxis.tooltip.defaultState.properties.opacity = 0;
	// valueAxis.tooltip.disabled                        = true;
	// valueAxis.cursorTooltipEnabled                    = false;
	// valueAxis.zIndex                                  = 10;

// Создание кольцевых сектотров на основе data_object
	let series_level_array = {
		level_1 : [],
		level_2 : [],
		level_3 : []
	};
	let selected_id = [];
	let selected_element = [];
	let selected_color = [];
	let sablevels_quantity = [0, 7, 5, 7];

	// при нажатии на ячейку задействуется этот блок
	let levelEl = $('#bigwheel-level');

	// это контейнер с информацией о выбранной ячейке
	let fileContainerEl = $('#bigwheel-files-container');

	// вызывается функция по нажатию на эту хуйню
	chart.events.on('unhitAll', function () {

		// добавление класса d-none, который скрывает описание по выбранной ячейке
		levelEl.addClass('d-none');

		// добавление класса d-none, который скрывает все содержимое описания внутри блока описания
		fileContainerEl.addClass('d-none').children().addClass('d-none');

		selected_element.forEach((element, i) => {
			let key_split = selected_id[ i ].split('_');
			element._element.node.firstChild.setAttribute('fill', selected_color[ selected_element.indexOf(element) ]);
			element.fillOpacity = fillOpacity(levels[ key_split[ 0 ] + '_' + key_split[ 1 ] ][ key_split[ 2 ] ]);
		});

		for (let i in chart.series._values) {
			let series = chart.series._values[ i ];
			for (let j in series.columns._values) {
				series.columns._values[ j ].hideTooltip();
			}
		}

		selected_element = [];
		selected_id = [];
		selected_color = [];
	});

	for (let level = 3; level > 0; level--) {

		for (let sublevel = sablevels_quantity[ level ]; sublevel > 0; sublevel--) {
			let index = level + "_" + sublevel;
			var series = chart.series.push(new am4charts.RadarColumnSeries());
			series.name = 'Level_' + index;
			series.stacked = true;
			series.columns.template.radarColumn.strokeOpacity = 1;
			series.columns.template.radarColumn.configField = "config" + level;
			series.columns.template.tooltipText = "{name}";
			series.dataFields.categoryX = "competence";
			series.dataFields.valueY = 'level_' + index;

			series.sequencedInterpolation = false;

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
				if (selected_element.indexOf(ev.target) == -1) {
					if (!multiselect) {
						selected_element.forEach((element, i) => {
							let key_split = selected_id[ i ].split('_');
							element._element.node.firstChild.setAttribute('fill', selected_color[ selected_element.indexOf(element) ]);
							element.fillOpacity = fillOpacity(levels[ key_split[ 0 ] + '_' + key_split[ 1 ] ][ key_split[ 2 ] ]);
						});
						selected_element = [];
						selected_id = [];
						selected_color = [];
					}

					ev.target.fillOpacity = 1;
					selected_id.push(index + '_' + ev.target.dataItem.index);
					selected_element.push(ev.target);
					selected_color.push(ev.target._element.node.firstChild.getAttribute('fill'));
					ev.target._element.node.firstChild.setAttribute('fill', active_color);

					// Block info.
					let sector = ev.target.dataItem.index;
					let key_split = index.split('_');
					let level = key_split[ 0 ];
					let context = ev.target.dataItem.dataContext;
					let type = context.type;
					let sublevel = key_split[ 1 ];
					let sublevelKey = level + '_' + sublevel;
					if (level == 1)
						sublevelKey = type + '_' + sublevelKey;

					levelEl.find('.title').html(levelNames[ level ]);
					levelEl.find('.subtitle').html(sublevelNames[ sublevelKey ]);
					levelEl.find('.competence').html(context.title);

					levelEl.removeClass('d-none');

					// Files.
					let value = levels[ level + '_' + sublevel ][ sector ];
					if (value == 599) {
						fileContainerEl.find('.alert-half').removeClass('d-none');
						fileContainerEl.find('.alert-none').addClass('d-none');
						fileContainerEl.find('.card').addClass('d-none');
					} else if (value < 100) {
						fileContainerEl.find('.alert-half').addClass('d-none');
						fileContainerEl.find('.alert-none').removeClass('d-none');
						fileContainerEl.find('.card').addClass('d-none');
					} else {
						fileContainerEl.find('.alert-half').addClass('d-none');
						fileContainerEl.find('.alert-none').addClass('d-none');
						if (typeof files[ level ] !== 'undefined'
							&& typeof files[ level ][ sublevel ] !== 'undefined'
							&& typeof files[ level ][ sublevel ][ sector ] !== 'undefined') {
							for (var i in files[ level ][ sublevel ][ sector ]) {
								var dEl = fileContainerEl.find('.data');
								dEl.html("");
								var t = $('#profile-bigwheel-competence-template');

								// тут данные тянутся из объекта files в джсоне, лелвле, саблелвел, сектор свойства
								for (var eventID in files[ level ][ sublevel ][ sector ]) {
									var blockFiles = files[ level ][ sublevel ][ sector ][ eventID ];
									var card = t.clone();
									card.removeAttr('id');

									if (blockFiles[ 0 ].tool !== undefined && blockFiles[ 0 ].tool.length > 0) {
										var tools = '';
										for (var tt in blockFiles[ 0 ].tool) {
											tools += '<span class="m-1 badge badge-primary">' + blockFiles[ 0 ].tool[ tt ] + '</span>'
										}
										card.find('.tool').html(tools);
									} else {
										card.find('.tool').remove();
									}

									if (typeof events[ eventID ] !== 'undefined') {
										var event = events[ eventID ];
										if (event.title.length > 0)
											card.find('.title span').html(event.title);
										else
											card.find('.title').remove();
										if (event.description.length > 0)
											card.find('.description').html(event.description).removeClass('d-none');
										if (typeof event.start !== 'undefined' && event.start != null && typeof event.end !== 'undefined' && event.end != null)
											card.find('.time span').html(event.start + ' - ' + event.end);
										else
											card.find('.time').remove();
										if (typeof event.type !== 'undefined')
											card.find('.type span').html(event.type);
										else
											card.find('.type').remove();
										if (typeof event.place !== 'undefined' && event.place != null)
											card.find('.place span').html(event.place);
										else
											card.find('.place').remove();
									} else {
										card.find('.title span').html(blockFiles[ 0 ].title);
										card.find('.time').remove();
										card.find('.type').remove();
									}

									var filesEl = card.find('.files');
									filesEl.html("");
									var filesEmpty = true;
									if (blockFiles.length > 0) {
										for (var i in blockFiles) {
											var file = blockFiles[ i ];
											if (file.file.length > 0) {
												if (typeof file.isConfirmed !== 'undefined' && file.isConfirmed == 1)
													var c = '<i class="fa fa-fw fa-check-circle text-success" title="Подтверждённый результат"></i>';
												else
													var c = '<i class="fa fa-fw fa-question-circle-o text-danger" title="Неподтверждённый результат"></i>';
												filesEl.append('<div class="file-item">' + c + '<a target="_blank" href="' + file.file + '">' + file.fileTitle + '</a></div>');
												filesEmpty = false;
											}
										}
									}
									if (filesEmpty) {
										filesEl.remove();
										card.find('.card-body').remove();
									}
									card.removeClass('d-none');
									dEl.append(card);
								}
								dEl.removeClass('d-none');
							}
						}
					}
					fileContainerEl.removeClass('d-none');
				} else {
					ev.target.fillOpacity = fillOpacity(levels[ index ][ ev.target.dataItem.index ]);
					ev.target._element.node.firstChild.setAttribute('fill', selected_color[ selected_element.indexOf(ev.target) ]);
					selected_element.splice(selected_element.indexOf(ev.target), 1);
					selected_id.splice(selected_element.indexOf(ev.target), 1);
					selected_color.splice(selected_element.indexOf(ev.target), 1);
					levelEl.addClass('d-none');
					fileContainerEl.find('.alert-half').addClass('d-none');
					fileContainerEl.find('.alert-none').addClass('d-none');
					fileContainerEl.addClass('d-none');
				}
			}, this);

			series_level_array[ 'level_' + level ][ sublevel ] = series;

		}
		var series_gap = chart.series.push(new am4charts.RadarColumnSeries());
		series_gap.stacked = true;
		series_gap.columns.template.radarColumn.strokeOpacity = 0;
		series_gap.columns.template.radarColumn.configField = "level_gap_config";
		series_gap.dataFields.categoryX = "competence";
		series_gap.dataFields.valueY = "level_gap";
		series_gap.sequencedInterpolation = false;
	}
	chart.seriesContainer.zIndex = -1;
	return chart;
	console.log('create chart');
}

// test

