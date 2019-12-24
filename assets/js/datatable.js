$(function(e) {
	'use strict';
	$('#example').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select id="e1" class="form-control select2 custom-filter custom-filter-sm w-100"><option value="">Semua Data</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	} );
	$('#tanggal').empty();
	$('#tanggal').append('<i>Filter &nbsp;</i><i style="color:#2aaff8;" class="ion-arrow-right-c"></i>');
	$('#action').empty();


	var table = $('#example1').DataTable();
	$('#example2').DataTable({
		"scrollY": "200px",
		"scrollCollapse": true,
		"paging": false
	});
	$('#example3').DataTable({
		responsive: {
			details: {
				display: $.fn.dataTable.Responsive.display.modal({
					header: function(row) {
						var data = row.data();
						return 'Details for ' + data[0] + ' ' + data[1];
					}
				}),
				renderer: $.fn.dataTable.Responsive.renderer.tableAll({
					tableClass: 'table'
				})
			}
		}
	});
});