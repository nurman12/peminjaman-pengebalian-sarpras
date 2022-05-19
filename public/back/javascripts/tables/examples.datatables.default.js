

(function ($) {

	'use strict';

	var datatableInit = function () {

		$('#datatable-default').dataTable();
		$('#datatable-default-1').dataTable();
		$('#datatable-default-2').dataTable();
		$('#datatable-default-3').dataTable();

	};

	$(function () {
		datatableInit();
	});

}).apply(this, [jQuery]);