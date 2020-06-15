<?php
	require_once("db_.php");

  $id=$_REQUEST['id'];
  $nombre="";
  $texto="";
  $corto="";
  $limite=date("d-m-Y");
  $noticia="";
  $alerta="";
  $baner="";
  $imagen="";
  if($id>0){
    $row = $db->blog_editar($id);
    $nombre=$row['nombre'];
    $texto=$row['texto'];
    $corto=$row['corto'];
    $limite=fecha($row['limite']);
    $noticia=$row['noticia'];
    $alerta=$row['alerta'];
    $baner=$row['baner'];
    $imagen=$row['imagen'];
    $adjunto=$row['adjunto'];
  }

  echo "<div class='container'>";
    echo "<form autocomplete=off id='form_personal' action='' data-lugar='admin/db_' data-funcion='blog_guardar' data-destino='admin/blog_editar'>";
    echo "<input  type='hidden' id='id' NAME='id' value='$id'>";
      echo "<div class='card'>";
        echo "<div class='card-header'>";
          echo "<img src='img/caja.png' width='20' alt='logo'> - ";
          echo "Mensaje";
        echo "</div>";
        echo "<div class='card-body'>";

          echo "<div class='row'>";
          /*
            if(strlen($imagen)<2 or !file_exists("archivos/".$imagen)){
              echo  "<div class='col-sm-2'>";
                echo "<img src='archivos/$imagen' width='100px' alt='Miniatura'>";
              echo "</div>";
            }
          */
            echo  "<div class='col-sm-3'>";
              echo "<label>Nombre</label>";
              echo "<input class='form-control' type='Texto Texto con formatotext' id='nombre' NAME='nombre' value='$nombre' maxlength='45' placeholder='Nombre del mensaje'>";
            echo "</div>";

            echo  "<div class='col-sm-4'>";
              echo "<label>Limite</label>";
              echo  "<input class='form-control fechaclass' type='text' id='limite' NAME='limite' value='$limite' maxlength='13' placeholder='Fecha'>";
            echo "</div>";

            echo  "<div class='col-sm-3'>";
              echo "<label>Tipo</label><br>";
                echo "<label><input type='checkbox' value='1' id='noticia' name='noticia'";  if($noticia==1){ echo " checked"; } echo ">Noticia</label>";
                echo "<label><input type='checkbox' value='1' id='alerta' name='alerta'";  if($alerta==1){ echo " checked"; } echo ">Alerta</label>";
                echo "<label><input type='checkbox' value='1' id='baner' name='baner'";  if($baner==1){ echo " checked"; } echo ">Banner</label>";

            echo "</div>";

            echo  "<div class='col-sm-12'>";
              echo "<label>Asunto</label>";
              echo "<input class='form-control' type='text' id='corto' NAME='corto' value='$corto' maxlength='200' placeholder='Asunto'>";
            echo "</div>";
          echo "</div>";

          echo "<div class='row'>";
            echo  "<div class='col-sm-12'>";
              echo "<label>Mensaje</label>";
              echo "<textarea class='form-control' type='text' id='texto' NAME='texto' placeholder='Mensaje' name='editordata'>$texto</textarea>";
            echo "</div>";
          echo "</div>";

        echo "</div>";
        echo "<div class='card-footer'>";
          echo "<div class='btn-group'>";
            echo "<button class='btn btn-warning btn-sm' type='submit' title='Guardar cambios' ><i class='far fa-save'></i>Guardar</button>";

            if($id>0){
              if(strlen($imagen)<2 or !file_exists("../archivos/".$imagen)){
  	            echo "<button type='button' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#myModal' id='fileup_foto' data-ruta='archivos/' data-tabla='bit_blog' data-campo='imagen' data-tipo='1' data-id='$id' data-keyt='id' data-destino='admin/blog_editar' data-iddest='$id' data-ext='.jpg,.png' title='Subir foto'><i class='fas fa-cloud-upload-alt'></i>Miniatura</button>";
  						}
  						else{
  							echo "<div class='btn-group' role='group'>";
  								echo "<button id='btnGroupDrop1' type='button' class='btn btn-warning btn-sm dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-paperclip'></i>Imagen</button>";

  								echo "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
  									echo "<a class='dropdown-item' href='archivos/".$imagen."' target='_blank'><i class='fas fa-paperclip'></i>Imagen</a>";
  									echo "<a class='dropdown-item' title='Eliminar archivo'
  									id='delfile_logo'
  									data-ruta='archivos/$imagen'
  									data-keyt='id'
  									data-key='".$id."'
  									data-tabla='bit_blog'
  									data-campo='imagen'
  									data-tipo='1'
  									data-iddest='$id'
  									data-divdest='trabajo'
  									data-borrafile='1'
  									data-dest='admin/blog_editar.php?id='
  									><i class='far fa-trash-alt'></i>Eliminar</a>";
  								echo "</div>";
  							echo "</div>";
  						}

							if(strlen($adjunto)<2 or !file_exists("../archivos/".$adjunto)){
								echo "<button type='button' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#myModal' id='fileup_foto' data-ruta='archivos/' data-tabla='bit_blog' data-campo='adjunto' data-tipo='1' data-id='$id' data-keyt='id' data-destino='admin/blog_editar' data-iddest='$id' data-ext='.*' title='Subir foto'><i class='fas fa-cloud-upload-alt'></i>Adjunto</button>";
							}
							else{
								echo "<div class='btn-group' role='group'>";
									echo "<button id='btnGroupDrop1' type='button' class='btn btn-warning btn-sm dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-paperclip'></i>Adjunto</button>";

									echo "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
										echo "<a class='dropdown-item' href='archivos/".$adjunto."' target='_blank'><i class='fas fa-paperclip'></i>Adjunto</a>";
										echo "<a class='dropdown-item' title='Eliminar archivo'
										id='delfile_logo'
										data-ruta='archivos/$adjunto'
										data-keyt='id'
										data-key='".$id."'
										data-tabla='bit_blog'
										data-campo='adjunto'
										data-tipo='1'
										data-iddest='$id'
										data-divdest='trabajo'
										data-borrafile='1'
										data-dest='admin/blog_editar.php?id='
										><i class='far fa-trash-alt'></i>Eliminar</a>";
									echo "</div>";
								echo "</div>";
							}
            }

            echo "<button class='btn btn-warning btn-sm' id='lista_penarea' data-lugar='admin/blog_lista' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>";
          echo "</div>";
        echo "</div>";
      echo "</div>";
    echo "</form>";
  echo "</div>";
?>

  <script>

  $(function() {
    fechas();

    $('#texto').summernote({
      lang: 'es-ES',
      placeholder: 'Mensaje de texto',
      tabsize: 5,
      height: 150,
      toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
  });
</script>
