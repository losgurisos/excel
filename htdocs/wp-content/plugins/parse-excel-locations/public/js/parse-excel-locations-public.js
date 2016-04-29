
           jQuery(document).ready(function () {

                var categoriesFilters = [];
                var depFilter = '';


                var items = jQuery(".item-list li");
                var cbFilters = jQuery(".cat-filter-checkbox");

                function initCategoryFilters() {
                    cbFilters.each(function () {
                        categoriesFilters[jQuery(this).attr('category')] = false;
                    });
                }

                cbFilters.change(function () {

                    var cat = jQuery(this).attr('category');

                    var index = categoriesFilters.indexOf(cat);

                    if (index === -1)
                        categoriesFilters.push(cat);
                    else
                        categoriesFilters.splice(index, 1);


                    reloadFilters();


                });


                jQuery("#cities-filter-select").change(function () {

                    depFilter = jQuery(this).val();
                    reloadFilters();

                });

                function reloadFilters() {

                    items.show()

                    var filtersApplied = [];

                    if (categoriesFilters.length) {
                        // apply category filter and dep if exists
                        for (var cat in categoriesFilters) {
                            filtersApplied.push(".cat-" + categoriesFilters[cat].toLowerCase() + (depFilter ? ".dep-" + depFilter : ""));
                        }
                    }
                    else if (depFilter !== '') {
                        // only apply dep filter
                        filtersApplied.push(".dep-" + depFilter);
                    }
                    else {
                        // show all
                        return;
                    }

                    // creating selector query
                    var selectorQuery = '.item-list li:not(';

                    for (var i in filtersApplied)
                        selectorQuery += filtersApplied[i] + ',';


                    selectorQuery = selectorQuery.substring(selectorQuery.length - 1, 0);
                    selectorQuery += ')';

                    // execute selector query
                    jQuery(selectorQuery).hide();

                }

            });

