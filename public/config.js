console.log('config load');
let config;
function loadBigwheel() {
  $.getJSON("datas_backup.json", function(result) {
    console.log(result);
    config = prepareBigwheelChartConfig(result);
    config.containerID = "profile-bigwheel";
    config.readyCallback = function(e) {
      e.target.dispatch("unhitAll");
      e.target.exporting.getImage("png").then(res => {
        window.bigWheelChartBase64 = res;
      });
    };
    createBigWheelChart(config, true);
  });
}

$(".hide-empty").on("click", function() {
  createBigWheelChart(config, true);
  $(this).addClass("d-none");
  $(".view-empty").removeClass("d-none");
});
$(".view-empty").on("click", function() {
  createBigWheelChart(config, false);
  $(".hide-empty").removeClass("d-none");
  $(".view-empty").addClass("d-none");
});
$(document).ready(function() {
  $("#bigwheel-model").change(function() {
    $("#profile-bigwheel").html(
      '<i class="fa fa-spinner fa-spin fa-3x fa-fw text-primary"></i>'
    );
    loadBigwheel($(this).val());
  });
});
