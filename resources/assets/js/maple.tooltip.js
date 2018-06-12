/*!
 * Maple Tooltip v1.0.0 by @corsair - https://github.com/corsair
 * A simple way to add MapleStory tooltips to your website, blog, etc.
 * License - https://github.com/corsair/maple-tooltip/LICENSE (MIT License)
 */

(function ($) {

    $.fn.mapleTooltip = function( options ) {

        var settings = $.extend({
            type: "monster",
            region: "gms",
            version: "latest"
        }, options);

        return this.each(function() {

            var region = settings.region;
            var version = settings.version;

            // Define tooltip variables
            var i = $(this);
            var id = i.attr("maple-id");

            // Define the API (Maplestory.io)
            var api = "https://maplestory.io/api/" + region + "/" + version + "/mob/" + id;

            // Update the element
            $(i).attr('href', 'https://maplestory.wiki/' + region + '/' + version + '/monster/' + id);

            $.get( api, function(data) {

                // Now that we have the item name, add it to the DOM.
                $(i).html(data.name);

                // Initialize tooltip blocks
                var hp = '';
                var mp = '';
                var exp = '';

                // Define tooltip blocks
                var level = "<li class='list-group-item bg-level'><b>Level "+data.meta.level+"</b></li>";

                if(typeof(data.meta.maxHP) != "undefined" && data.meta.maxHP !== null) {
                    var hp = "<li class='list-group-item bg-dark text-white'><b>"+data.meta.maxHP.toLocaleString("en")+"</b> Health</li>";
                }
                if(typeof(data.meta.maxMP) != "undefined" && data.meta.maxMP !== null) {
                    var mp = "<li class='list-group-item bg-dark text-white'><b>"+data.meta.maxMP.toLocaleString("en")+"</b> Mana</li>";
                }
                if(typeof(data.meta.exp) != "undefined" && data.meta.exp !== null) {
                    var exp = "<li class='list-group-item bg-dark text-white'><b>"+data.meta.exp.toLocaleString("en")+"</b> Experience</li>";
                }

                content = document.createElement('span');
                content.innerHTML = "<img src='"+api+"/icon?resize=2' class='pixels' style='max-width:100%;margin:10px auto;display:block;'/>" +
                "<ul class='list-group bg-dark text-white'>" + level + hp + mp + exp + "</ul>";

                // Create the popover
                tippy('[maple-id="'+id+'"', {
                    allowTitleHTML: true,
                    html: content,
                    theme: 'light',
                    delay: 100,
                    arrow: true,
                    size: 'medium',
                    duration: 100,
                    animation: 'shift-away',
                    followCursor: true,
                    maxWidth: '250px',
                    placement: 'right',
                });
            });
        });
    };

}( jQuery ));