$(document).ready(function () {
    (function () {
        // setup your carousels as you normally would using JS
        // or via data attributes according to the documentation
        // https://getbootstrap.com/javascript/#carousel
        $('#carou-news').carousel({
            interval: false
        });
        $('#carou-link').carousel({
            interval: 5000
        });        
        $('#carou-tri').carousel({
            interval: 5000
        });        
        $('#carou-one').carousel({
            interval: 3000
        });
    }());

    (function () {
        $('.carousel-showsixmoveone .item').each(function () {
            var itemToClone = $(this);

            for (var i = 1; i < 6; i++) {
                itemToClone = itemToClone.next();

                // wrap around if at end of item collection
                if (!itemToClone.length) {
                    itemToClone = $(this).siblings(':first');
                }

                // grab item, clone, add marker class, add to collection
                itemToClone.children(':first-child').clone()
                    .addClass("cloneditem-" + (i))
                    .appendTo($(this));
            }
        });
        $('.carousel-showfourmoveone .item').each(function () {
            var itemToClone = $(this);

            for (var i = 1; i < 4; i++) {
                itemToClone = itemToClone.next();

                // wrap around if at end of item collection
                if (!itemToClone.length) {
                    itemToClone = $(this).siblings(':first');
                }

                // grab item, clone, add marker class, add to collection
                itemToClone.children(':first-child').clone()
                    .addClass("cloneditem-" + (i))
                    .appendTo($(this));
            }
        });
        $('.carousel-showtwomoveone .item').each(function () {
            var itemToClone = $(this);

            for (var i = 1; i < 2; i++) {
                itemToClone = itemToClone.next();

                // wrap around if at end of item collection
                if (!itemToClone.length) {
                    itemToClone = $(this).siblings(':first');
                }

                // grab item, clone, add marker class, add to collection
                itemToClone.children(':first-child').clone()
                    .addClass("cloneditem-" + (i))
                    .appendTo($(this));
            }
        });
        $('.carousel-showtrimoveone .item').each(function () {
            var itemToClone = $(this);

            for (var i = 1; i < 3; i++) {
                itemToClone = itemToClone.next();

                // wrap around if at end of item collection
                if (!itemToClone.length) {
                    itemToClone = $(this).siblings(':first');
                }

                // grab item, clone, add marker class, add to collection
                itemToClone.children(':first-child').clone()
                    .addClass("cloneditem-" + (i))
                    .appendTo($(this));
            }
        });
        $('.carousel-showonemoveone .item').each(function () {
            var itemToClone = $(this);

            for (var i = 1; i < 1; i++) {
                itemToClone = itemToClone.next();

                // wrap around if at end of item collection
                if (!itemToClone.length) {
                    itemToClone = $(this).siblings(':first');
                }

                // grab item, clone, add marker class, add to collection
                itemToClone.children(':first-child').clone()
                    .addClass("cloneditem-" + (i))
                    .appendTo($(this));
            }
        });
    }());
});
