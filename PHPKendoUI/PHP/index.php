//Prueba 1, Pablo Colabora con este Código
<!DOCTYPE html> 
<html> 
	<head> 
		<link href="css/kendo.metro.min.css" rel="stylesheet"> 
		<link href="css/kendo.common.min.css" rel="stylesheet"> 
		<script src="js/jquery.min.js"></script>
		<script src="js/kendo.all.min.js"></script>
	</head>
	<body> 
		<div id="grid"></div> 
		<script>
        $(function() {
            $("#grid").kendoGrid({
				dataSource: {
					transport: {
						read: "data/employees.php",
						update: {
							url: "data/employees.php",
							type: "POST"
						}
					},
					error: function(e) {
						alert(e.responseText);
					}	
					schema: {
						data: "data",
						model: {
							id: "EmployeeID",
							fields: {
								FirstName: { editable: false },
								LastName: { validation: { required: true} }
							}
						}
					}
				},
				columns: [{ field: "FirstName" }, { field: "LastName" }, { field: "Country" }, { field: "City" }, { field: "Title" }],
				detailTemplate: kendo.template($("#template").html()),
				detailInit: detailInit,
				editable: true,
				navigable: true,  // enables keyboard navigation in the grid
				toolbar: [ "save", "cancel" ]  // adds save and cancel buttons
			});
        });
		
		function detailInit(e) {
		// get a reference to the current row being initialized var detailRow = e.detailRow;

		// create a subgrid for the current detail row, getting territory data for this employee
			detailRow.find(".subgrid").kendoGrid({
				dataSource: {
					transport: {
						read: "data/territories.php"
					},
					schema: {
						data: "data"
					},
					serverFiltering: true,
					filter: { field: "EmployeeID", operator: "eq", value: e.data.EmployeeID }
				},
				columns: [{ title: "Territorios", field: "TerritoryDescription" }],
			});
		}
		</script> 
	</body>
</html> 
