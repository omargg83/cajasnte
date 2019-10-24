			$(document).ready(function(){
				$("#cargando").removeClass("is-active");
				load();
				$.notify({
					icon: 'fas fa-user-check',
					message: "Bienvenido"

				},{
					type: 'success',
					timer: 4000
				});
			});
			
			$(document).on("click",'.home',function(){
				load();
			});
		
			function load(){
				$.ajax({
					url:'afiliado/afiliado.php',
					beforeSend: function(objeto){
						$("#cargando").addClass("is-active");
						$("#contenido").html("Procesando, espere por favor...");
					},
					success:function(response){
						$("#contenido").html('');
						$("#contenido").html(response);
						$("#cargando").removeClass("is-active");						
					}
				})
			}
			
			$(document).on("click",'.creditos',function(){
				var xyId = 0;
				 $.ajax({
						data:  {parametros:xyId},
						url:   'creditos/credito.php',
						type:  'post',
				  beforeSend: function () {
					$("#datos").html("Procesando, espere por favor...");
				  },
				  success:  function (response) {
					$("#datos").html('');
					$("#datos").html(response);
				  }
				});
			});
		   
		   $(document).on("click",'.ahorro',function(){
				var xyId = 0;
				 $.ajax({
						data:  {parametros:xyId},
						url:   'ahorro/ahorro.php',
						type:  'post',
				  beforeSend: function () {
					$("#datos").html("Procesando, espere por favor...");
				  },
				  success:  function (response) {
					$("#datos").html('');
					$("#datos").html(response);
				  }
				});
			});
		   
			$(document).on("click",'.pass',function(){
				var tipo = "password";
				 $.ajax({
						data:  {"tipo":tipo},
						url:   'pass/pass.php',
						type:  'post',
				  beforeSend: function () {
					$("#datos").html("Procesando, espere por favor...");
				  },
				  success:  function (response) {
					$("#datos").html('');
					$("#datos").html(response);
				  }
				});
			});
			
			$(document).on("click",'.acceso',function(){
				var tipo = "acceso";
				 $.ajax({
						data:  {"tipo":tipo},
						url:   'pass/pass.php',
						type:  'post',
				  beforeSend: function () {
					$("#datos").html("Procesando, espere por favor...");
				  },
				  success:  function (response) {
					$("#datos").html('');
					$("#datos").html(response);
				  }
				});
			});
		   
			$(document).on("change",'#clv_cred',function(){
			    var parametros =$(this).val();
			  			  
				var xyId = 0;
				 $.ajax({
						data:  {parametros:parametros},
						url:   'creditos/datos.php',
						type:  'post',
				  beforeSend: function () {
					$("#datos_cred").html("Procesando, espere por favor...");
				  },
				  success:  function (response) {
					$("#datos_cred").html('');
					$("#datos_cred").html(response);
				  }
				});
			});
			
			$(document).on("click",'#imprime_C',function(){
				var clv_cred = $("#clv_cred").val();
				VentanaCentrada('creditos/imprimir.php?clv_cred='+clv_cred,'Pedido','','1024','768','true'); 
			});
			
			$(document).on("click",'#imprime_A',function(){
				var periodo = $("#periodo").val();
				VentanaCentrada('ahorro/imprimir.php?periodo='+periodo,'Pedido','','1024','768','true'); 
			});
			
			$(document).on("click",'#imprime_F',function(){
				var periodo = $("#periodo").val();
				VentanaCentrada('creditos/formato.php','Pedido','','1024','768','true'); 
			});
			
			
			$(document).on('submit',function(e){
				e.preventDefault();
				var form;
				
				$(this).attr('action', 'page1');
				
				var btn=$(this).find(':submit');
				var dataString = $( "form" ).serialize();
				
				form=$(btn).data("form");
				dataString=dataString+"&tipo="+form;	
				
				var btn=$(this).find('.guardar');
				$(btn).attr('disabled', 'disabled');
				var tmp=$(btn).children("i").attr('class');
				$(btn).children("i").removeClass();
				$(btn).children("i").addClass("fas fa-spinner fa-pulse");				
				
				$.ajax({
					data:  dataString,
					url:   'pass/guardar.php',
					type:  'post',
					beforeSend: function () {
						$("#alertas").html("Procesando, espere por favor...");
					},
					success:  function (response) {
						if (!isNaN(response)){
							swal({
								  title: "Se guardó correctamente",
								  text: "",
								  type: "success",
								  showCancelButton: false,
								  confirmButtonColor: "#34495E",
								  confirmButtonText: "Continuar!",
								  closeOnConfirm: true,
								  html: false
							}, function(){
								
							});
						}
						else{
							alert(response);
						}
						$(btn).children("i").removeClass();
						$(btn).children("i").addClass(tmp);
						$(btn).prop('disabled', false);
						$("#mensaje").html('');
					}
				});
				return false;
			});
			