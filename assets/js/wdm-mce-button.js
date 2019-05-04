(function() {
       tinymce.PluginManager.add('wdm_mce_button', function( editor, url ) {
           editor.addButton('wdm_mce_button', {
                       text: 'BUY TICKET BUTTON',
                       class: 'button',
                       icon: false,
                       classes: 'buy-tick-btn',
                       onclick: function() {
                         // change the shortcode as per your requirement
                          editor.insertContent('<a class="buyTicketBtn" href="#"><i>Buy Ticket</i></a>');
                      }
             });
       });
})();