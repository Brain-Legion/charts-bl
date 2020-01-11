window.onload = function () {

  let arr = [];

  am4core.ready(function () {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    var chart = am4core.create("chartdiv", am4charts.RadarChart);
    chart.hiddenState.properties.opacity = -1; // this creates initial fade-in

    fetch(`http://localhost:8080/getCategories/Nick`).then(response => {
      response.json().then(data => {
        arr = data[0].categories;
        chart.data = arr;
        chart.data.map(el => {
          el.color = chart.colors.next()
        })
        chart.padding(20, 20, 20, 20);

        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "category";
        categoryAxis.renderer.labels.template.location = 0.5;
        categoryAxis.renderer.tooltipLocation = -2;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.labels.template.disabled = true;
        valueAxis.min = 0;
        valueAxis.max = 20;
        valueAxis.renderer.minGridDistance = 5;

        var series = chart.series.push(new am4charts.RadarColumnSeries());
        series.columns.template.tooltipText = "{categoryX}: {valueY.value}";
        series.columns.template.width = am4core.percent(100);
        series.columns.template.strokeWidth = 0;
        series.columns.template.column.propertyFields.fill = "color";
        series.dataFields.categoryX = "category";
        series.dataFields.valueY = "value";
      })
    })

  }); // end am4core.ready()





  // logout button
  function logout() {
    location.href = "login.html";
  }


  // load digital print
  function goToLoadPrint() {
    location.href = "loadprint.html";
  }



  // login functions
  function studentLogin() {
    location.href = "index.html";
  }
  function teacherLogin() {
    location.href = "teacherprofile.html";
  }


  // tabpanel script
  function openTab(e, tabId) {
    var i, tabcontent, tablink;

    // hide all tabcontent content when tab button is click
    tabcontent = document.getElementsByClassName('tab-content');
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }

    // remove active for the tablinks if its actvie
    tablink = document.getElementsByClassName('tab-link');
    for (i = 0; i < tablink.length; i++) {
      tablink[i].className = tablink[i].className.replace('btn-left-menu-active', "");
    }

    document.getElementById(tabId).style.display = "block";
    e.currentTarget.className += ' btn-left-menu-active';
  }
}





// window.onload = function () {

//   let arr = [];

//   am4core.ready(function () {

//     am4core.useTheme(am4themes_animated);

//     var chart = am4core.create("chartdiv", am4charts.RadarChart);
//     // /getCategories/<name>
//     fetch(`http://localhost:8080/getCategories/Nick`).then(response => {
//       response.json().then(data => {
//         arr = data[0].categories;
//         chart.data = arr;
//         chart.radius = am4core.percent(100);
//         chart.innerRadius = am4core.percent(50);

//         var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
//         categoryAxis.dataFields.category = "category";
//         categoryAxis.renderer.grid.template.location = 0;
//         categoryAxis.renderer.minGridDistance = 30;
//         categoryAxis.tooltip.disabled = true;
//         categoryAxis.renderer.minHeight = 110;
//         categoryAxis.renderer.grid.template.disabled = true;

//         // Настройки положения надписи
//         let labelTemplate = categoryAxis.renderer.labels.template;
//         labelTemplate.radius = am4core.percent(-90);
//         labelTemplate.location = 0.5;
//         labelTemplate.relativeRotation = 90;

//         var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
//         valueAxis.renderer.grid.template.disabled = true;
//         valueAxis.renderer.labels.template.disabled = true;
//         valueAxis.tooltip.disabled = true;

//         var series = chart.series.push(new am4charts.RadarColumnSeries());
//         series.sequencedInterpolation = true;
//         series.dataFields.valueY = "value";
//         series.dataFields.categoryX = "category";
//         series.columns.template.strokeWidth = 0;
//         series.tooltipText = "{valueY}";
//         series.columns.template.radarColumn.cornerRadius = 10;
//         series.columns.template.radarColumn.innerCornerRadius = 0;

//         series.tooltip.pointerOrientation = "vertical";

//         let hoverState = series.columns.template.radarColumn.states.create("hover");
//         hoverState.properties.cornerRadius = 0;
//         hoverState.properties.fillOpacity = 1;


//         series.columns.template.adapter.add("fill", function (fill, target) {
//           return chart.colors.getIndex(target.dataItem.index);
//         })

//         chart.cursor = new am4charts.RadarCursor();
//         chart.cursor.innerRadius = am4core.percent(50);
//         chart.cursor.lineY.disabled = true;

//       });
//     });

//     const upload = elem => {
//       const formData = new FormData();
//       formData.append('file', elem.files[0]);
//       fetch(`http://localhost:8080/sendFile/Nick/${elem.dataset.value}`, {
//         method: 'POST',
//         body: formData
//       }).then(response => response.json().then(data => {
//         chart.data = data.categories
//         chart.validateData()
//         elem.value = null;
//       }))
//     };

//     document.querySelectorAll('.btn__input').forEach(elem => {
//       elem.addEventListener('change', () => {
//         upload(elem)
//       });
//     })
//   })
// }

