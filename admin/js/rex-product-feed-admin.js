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

    /**
    * Add a new table-row and update it's
    */
    $(document).on('click', '#rex-new-attr', function () {
        var rowId = $('#config-table tbody tr').length;
        $("#config-table tbody tr:first")
            .clone()
            .insertAfter('#config-table tbody tr:last')
            .attr('data-row-id', rowId);

        var $row = $('#config-table').find("[data-row-id='" + rowId + "']");

        $row.find('input, select').val('');

        updateFormNameAtts( $row, rowId);


    });

    /**
     * Delete a table-row and update all row-id
     * beneath it and their input attributes names.
     */
    $(document).on('click', '#config-table .delete', function () {
        var $nextRows, rowId;

        // delete row and get it's row-id
        rowId = $(this).closest('tr').remove().data('row-id');

        // Gell the next rows
        if ( rowId == 0) {
            $nextRows = $('#config-table tbody').children();
        }else{
            $nextRows = $('#config-table').find("[data-row-id='" + (rowId -1) + "']").nextAll('tr');
        }

        // Update their row-id and name attributes
        $nextRows.each( function (index, el) {
            $(el).attr( 'data-row-id', rowId);
            updateFormNameAtts( $(el), rowId);
            rowId++;
        });
    });

    /**
     * Function for updating select and input box name
     * attribute under a table-row.
     */
    function updateFormNameAtts( $row, rowId){
        var name, $el;
        $el = $row.find('input, select');
        $el.each(function(index, item) {
            name = $(item).attr('name');
            // get new name via regex
            name = name.replace(/^fc\[\d+\]/, 'fc[' + rowId + ']');
            $(item).attr('name', name);
        });

        return;
    }

    $(document).on('change', 'select.type-dropdown', function () {
        var selected = $(this).find('option:selected').val();
        if ( selected == 'static' ) {
            $(this).closest('td').next('td').find('.meta-dropdown').hide();
            $(this).closest('td').next('td').find('.static-input').show();
        }else{
            $(this).closest('td').next('td').find('.static-input').hide();
            $(this).closest('td').next('td').find('.meta-dropdown').show();
        }
    });

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
                items: $('#rex_feed_product_items').val().split(',').slice()
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
