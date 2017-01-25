(function( $ ) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
	 *
	 * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
	 *
	 * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

    function get_checkbox_val( name ){
        var items = 'input[name="rex_feed_' + name + '[]"]';
        var vals = [];

        $(items).each( function (){
            if( $(this).prop('checked') == true){
                vals.push( $(this).val() );
            }
        });

        return vals;
    };

    function save_feed(event) {
        event.preventDefault();

        var $payload = {
            merchant: $('#rex_feed_merchant').find(':selected').val(),
            info : {
                post_id: $('#post_ID').val(),
                title: $('#title').val(),
                desc: $('#title').val(),
            },

            products: {
                products_scope: $('#rex_feed_products').find(':selected').val(),
                tags: get_checkbox_val('tags'),
                cats: get_checkbox_val('cats'),
            }
        };

        wpAjaxHelperRequest( 'my-handle', $payload )
            .success( function( response ) {
                console.log( 'Woohoo!' );
                // 'response' will be the response from the handle's callback function, as either a string or JSON.
                console.log( response );
                $(document).off( 'click', '#publish', save_feed );
                $('#publish').trigger( 'click' );
            })
            .error( function( response ) {
                console.log( 'Uh, oh!' );
                console.log( response.statusText );
            });
    }

    $(document).on('click', '#publish', save_feed);


})( jQuery );
