define(['bootstrap', 'lib/isotope'], function (news, isotope) {
    var MyNews = function () {
        var container = news.$('#container');

        container.imagesLoaded(function () {
            container.isotope({
                itemSelector : '.photo'
            });
        });

        news.$('.header').click(function (e) { news.$('#user-cta').toggleClass('open'); news.$(this).toggleClass('open'); });

    };

    MyNews.prototype = {


    };

    return MyNews;
        
});