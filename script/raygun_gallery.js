// JavaScript Document
(function() {
    tinymce.create('tinymce.plugins.mylink', {
        init : function(ed, url) {
            ed.addButton('mylink', {
                title : 'Gallery',
                image : url+'/gallery.png',
                onclick : function() {
                     ed.selection.setContent('[portfolio_slideshow centered=true click=lightbox thumbnailsize=80]');
 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('mylink', tinymce.plugins.mylink);
})();