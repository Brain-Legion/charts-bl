var chartsCallbacks = {
  bigwheel: {
    loadIsland1022: function() {
      loadIsland1022();
    },
    loadArchetype: function() {
      loadArchetype();
    },
    loadMotivation: function() {
      loadMotivation();
    },
    loadCulture: function() {
      loadCulture();
    },
    loadStars: function() {
      loadStars();
    },
    loadProfDialog: function() {
      loadProfDialog();
    },
    loadMetaUniversity: function() {
      loadMetaUniversity();
    }
  },
  island1022: {
    loadArchetype: function() {
      loadArchetype();
    },
    loadMotivation: function() {
      loadMotivation();
    },
    loadCulture: function() {
      loadCulture();
    },
    loadStars: function() {
      loadStars();
    },
    loadProfDialog: function() {
      loadProfDialog();
    },
    loadMetaUniversity: function() {
      loadMetaUniversity();
    }
  },
  archetype: {
    loadMotivation: function() {
      loadMotivation();
    },
    loadCulture: function() {
      loadCulture();
    },
    loadStars: function() {
      loadStars();
    },
    loadProfDialog: function() {
      loadProfDialog();
    },
    loadMetaUniversity: function() {
      loadMetaUniversity();
    }
  },
  motivation: {
    loadCulture: function() {
      loadCulture();
    },
    loadStars: function() {
      loadStars();
    },
    loadProfDialog: function() {
      loadProfDialog();
    },
    loadMetaUniversity: function() {
      loadMetaUniversity();
    }
  },
  culture: {
    loadStars: function() {
      loadStars();
    },
    loadProfDialog: function() {
      loadProfDialog();
    },
    loadMetaUniversity: function() {
      loadMetaUniversity();
    }
  },
  stars: {
    loadProfDialog: function() {
      loadProfDialog();
    },
    loadMetaUniversity: function() {
      loadMetaUniversity();
    }
  },
  profdialog: {
    loadMetaUniversity: function() {
      loadMetaUniversity();
    }
  }
};

var loadNextChart = function(name) {};

$(document).ready(function() {
  loadBigwheel();
  console.log('load chart');
});
