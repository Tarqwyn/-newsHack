define(['bootstrap', 'lib/isotope', 'lib/appear'], function (news, isotope, appear) {
    var MyNews = function () {

        news.$(function () {
            news.$(document.body).on('appear', '.photo', function (e, $affected) {
            // add class called “appeared” for each appeared element
                console.log('appearing');
                news.$(this).addClass('appeared');
            });
            news.$('.photo').appear({force_process: true});
        });

        var container = news.$('#content');

        container.imagesLoaded(function () {
            container.isotope({
                itemSelector : '.photo'
            });
        });

        news.$('.tweets').each(function () {
                var id = news.$(this).html();
                news.$.ajax({
                  url: 'http://localhost:8888/newshack/application/controllers/ajax.php',
                  data: id,
                  sucess : function () {
                     console.log(this);
                  }
                });
            }
        );

 

        news.$('.header').click(function (e) { news.$('#user-cta').toggleClass('open'); news.$(this).toggleClass('open'); });

    };

    MyNews.prototype = {


    };

    return MyNews;
        
});