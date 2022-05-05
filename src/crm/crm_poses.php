<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   </head>
   <body>
       <?php include('menu.php'); ?>

      <div id='liste'>
         <div class="row">
            <h1 class="text-center mt-5 mb-5">Gestion des poses</h1>
            <br>
         </div>
         <div class="row">
            <button id='btn_ajout_pose' type="button" class='btn btn-success mx-auto w-25'>Ajouter</button>
         </div>
         <div class="row">

            <div class='col-2'>
               <select id='select_categorie' class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                </select>
            </div>
              <div class='col-2'>
               <select id='select_sous_categorie' class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                </select>
            </div>

         </div>

         <form>
                <div class="row">
                <table class="table mx-auto" style="width: 90%;">
                <thead>
                    <tr>
                        <th scope="col" class="col-1">#</th>
                        <th scope="col" class="col-3">Filtre</th>
                        <th scope="col" class="col-3">Favori</th>
                        <th scope="col" class="col-2">Date Maj</th>
                        <th scope="col" class="col-2">Actif</th>
                        <th scope="col" colspan="3" class="col-3">Actions</th>
                    </tr>
                </thead>
                <tbody id='liste_poses'>
                </tbody>
                </table>
            </div>
        </form>
      </div>

      
      <div id='ajout_pose' style='display:none'>
         <div class="row">
            <h1 class="text-center mt-5 mb-5">Ajouter d'une pose</h1>
            <br>
         </div>
         <div class="row">
            <div class='mx-auto' style="width: 90%;">
               <div class="mb-3">
                   <input id='id_sous_categorie' type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" style='display:none'>
                 </div>

               <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Sélection du filtre</label>
                   <select id='select_filtre' class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"></select>
               </div>

               <div class="mb-3">
                   <input id='nom_filtre' type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Saisir le nom du filtre">
               </div>

               <div class="row">
                  <div class="col-6 p-2">
                     <input type="file" class="form-control" accept="image/*" onchange="loadFile(event)">
                     <div class='border'>
                        <img id='sunset' src='' width='100%' >
                     </div>
                  </div>
                  <div class="col-6 p-2">
                     <button class='btn btn-success' onclick="cropImg()">Cropper</button>
                     <label for="name">X</label>
                     <input type="text" id="x" name="x" required value="0" minlength="0" maxlength="100" size="10">
                     <label for="name">Y</label>
                     <input type="text" id="y" name="y" required value="0" minlength="0" maxlength="100" size="10">
                     <div class='border'>
                        <canvas id="canvas" width='500px' height='700px'>
                        </canvas>
                     </div>
                  </div>
               </div>
               <div class='row' style="display: block;">
                  <textarea id='base64'></textarea> 
               </div>
               <button id='btn_confirmer_ajout' class="btn btn-success">Confirmer</button>
               <button id='btn_annule_ajout' class="btn btn-warning">Annuler</button>
            </div>
         </div>
      </div>

      <div id='maj_pose' style='display:none'>
         <div class="row">
            <h1 class="text-center mt-5 mb-5">Modifier une pose</h1>
            <br>
         </div>
         <div class="row">
            <div class='mx-auto' style="width: 90%;">
              <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Id pose</label>
                  <input id='id_pose' type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
               </div>
               <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Sélection du filtre</label>
                   <select id='maj_select_filtre' class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"></select>
               </div>

               <div class="mb-3">
                   <input id='maj_nom_filtre' type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Saisir le nom du filtre">
               </div>
               <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Photo</label>
                  <div class="col-3">
                     <img src='' id='maj_photo_pose' >
                  </div>
               </div>
               <div class="row">
                  <div class="col-6 p-2">
                     <input type="file" accept="image/*" onchange="maj_loadFile(event)">
                     <div class='border'>
                        <img id='maj_sunset' src='' width='100%' >
                     </div>
                  </div>
                  <div class="col-6 p-2">
                     <button class='btn btn-warning' onclick="maj_cropImg()">Cropper</button>
                     <label for="name">décalage sur X</label>
                     <input type="text" id="maj_x" name="x" required value="0" minlength="0" maxlength="100" size="10">
                     <label for="name">décalage sur Y</label>
                     <input type="text" id="maj_y" name="y" required value="0" minlength="0" maxlength="100" size="10">
                     <div class='border'>
                        <canvas id="maj_canvas" width='747px' height='299px'>
                        </canvas>
                     </div>
                  </div>
               </div>
               <div class='row'  style="display: none;">
                  <textarea id='maj_base64'></textarea> 
               </div>
               <button id='btn_confirmer_maj' class="btn btn-success">Confirmer</button>
               <button id='btn_annule_maj' class="btn btn-warning">Annuler</button>
            </div>
         </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      <script>

         /* -------------------------------------------------------------------------- */
         /* Génération des listes catégories, sous catégories et des poses par defaut  */
         /* -------------------------------------------------------------------------- */

         form_select_categorie();

         form_select_sous_categorie($('#select_categorie').val());

         liste_poses($('#select_sous_categorie').val());

         /* -------------------------------------------------------------------- */
         /* Affichage de la liste des des poses.                                 */
         /* -------------------------------------------------------------------- */
         
         const select_categorie = document.getElementById("select_categorie");
         select_categorie.addEventListener("change", function() {
            form_select_sous_categorie($('#select_categorie').val());
            liste_poses($('#select_sous_categorie').val());
         });

         const select_sous_categorie = document.getElementById("select_sous_categorie");
         select_sous_categorie.addEventListener("change", function() {
            liste_poses($('#select_sous_categorie').val());
         });

         const select_filtre = document.getElementById("select_filtre");
         select_filtre.addEventListener("change", function() {
            if ($('#select_filtre').val() != -1){
               $('#nom_filtre').hide();
            } else {
               $('#nom_filtre').show();
            }
         });

         /* -------------------------------------------------------------------- */
         /* Détection du bouton "Ajout une pose"                                 */
         /* -------------------------------------------------------------------- */
         
         const btn_ajout_pose = document.getElementById("btn_ajout_pose");
         btn_ajout_pose.addEventListener("click", function() {
           $('#liste').hide();
           $('#id_sous_categorie').val($('#select_sous_categorie').val());
           form_select_filtre($('#select_sous_categorie').val(), 'AJOUT');
           $('#nom_filtre').show();
           $('#ajout_pose').show();
         });
         
         /* -------------------------------------------------------------------- */
         /* Détection du bouton "Annulation de l'ajout de la catégorie"          */
         /* -------------------------------------------------------------------- */
         
         const btn_annule_ajout = document.getElementById("btn_annule_ajout");
         btn_annule_ajout.addEventListener("click", function() {
           $('#liste').show();
           $('#ajout_categorie').hide();
         });

         /* -------------------------------------------------------------------- */
         /* Détection du bouton "Annulation de l'ajout de la catégorie"          */
         /* -------------------------------------------------------------------- */
         
         const btn_annule_maj = document.getElementById("btn_annule_maj");
         btn_annule_maj.addEventListener("click", function() {    
           $('#liste').show();
           $('#maj_pose').hide();
         });
         
         /* -------------------------------------------------------------------- */
         /* Détection du bouton "Confirmation de l'ajout de la catégorie"        */
         /* -------------------------------------------------------------------- */
         
         const btn_confirmer_ajout = document.getElementById("btn_confirmer_ajout");
         btn_confirmer_ajout.addEventListener("click", function() {
            $erreur = '';

            if ($('#select_filtre').val() === -1){
               if ($('#nom_filtre').val() === '') {
                  $erreur = 'Le nom du filtre est obligatoire';
                  alert($erreur);
               } 
            }

            if ($('#base64').val()==='') {
               $erreur = "Vous n'avez pas croppé l'image ou l'image n'est pas chargés.";
               alert($erreur);
            } 

            if ($erreur === '') {
               var $nom_filtre = '';
               $id_sous_categorie = $('#id_sous_categorie').val();
               if ($('#select_filtre').val() == -1) {
                  $nom_filtre = $('#nom_filtre').val();
               } else {
                  $nom_filtre = $('#select_filtre option:selected').text();
                }
 
               $.ajax({
                        url: '../../php/ajout_pose.php',
                        data: 'id_sous_categorie=' + $id_sous_categorie + '&id_filtre=' + $('#select_filtre').val() + '&nom_filtre=' + $nom_filtre + '&photo_pose=' + $('#base64').val(),
                        type : 'POST',
                        dataType: 'json',
                        async: true,
                        success: function(data) { 
                              switch (data.CODE_RETOUR) {
                                 case 'OK':
                                    liste_poses();
                                    $('#liste').show();
                                    $('#ajout_pose').hide();
                                    break;
                                 case 'ANOMALIE':
                                    // GESTION DES ERREURS
                                    break;
                                 default:
                                    // GESTION DES ERREURS
                                    break;
                              }
                        },
                        error: function (xhr, textStatus, errorThrown) {
                              console.log(xhr, textStatus, errorThrown); //always the same for refused and insecure responses.
                        }
                     });
               } 
         }); 
         /* -------------------------------------------------------------------- */
         /* Détection du bouton "Confirmation de la mise à jour de la catégorie" */
         /* -------------------------------------------------------------------- */
         
         const btn_confirmer_maj = document.getElementById("btn_confirmer_maj");
         btn_confirmer_maj.addEventListener("click", function() {

           $erreur = '';

            // Le nom de la catégorie est obligatoire
            if ($('#maj_nom_pose').val()==='') {
               $erreur = 'Le nom de la sous catégorie est obligatoire';
               alert($erreur);
            } 

            // L 'image est chargée mais n'est. pas croppée
            if (document.getElementById('maj_sunset').src !='' && $('#maj_base64').val()==='') {
               $erreur = "L'image n'est pas croppée !";
               alert($erreur);
            } 
            
           if ($erreur === '') {

            $maj_select_filtre   = $('#maj_select_filtre').val();
            $maj_nom_filtre      = $('#maj_nom_filtre');

            $.ajax({
                  url: '../../php/maj_pose.php',
                  data: 'id_pose=' + $('#id_pose').val() + '&id_filtre=' + $maj_select_filtre + '&nom_filtre=' + $maj_nom_filtre + '&maj_photo_pose=' + $('#maj_base64').val(),
                  type : 'POST',
                  dataType: 'json',
                  async: true,
                  success: function(data) { 
                        switch (data.CODE_RETOUR) {
                           case 'OK':
                              liste_poses();
                              $('#liste').show();
                              $('#maj_pose').hide();
                              break;
                           case 'ANOMALIE':
                              // GESTION DES ERREURS
                              break;
                           default:
                              // GESTION DES ERREURS
                              break;
                        }
                  },
                  error: function (xhr, textStatus, errorThrown) {
                        console.log(xhr, textStatus, errorThrown); //always the same for refused and insecure responses.
                  }
            });
           }
         });
         
         /* -------------------------------------------------------------------- */
         /* Détection du click de les boutons "Modifier" "Supprimer"             */
         /* -------------------------------------------------------------------- */
         
         var table = document.querySelector('table');
         table.addEventListener('click', function (ev) {
             var ligne = ev.target.id;
             $choix = ligne.split("-");
         
             switch ($choix[0]) {
               case 'M':
                  $.ajax({
                     url: '../../php/edition_pose.php',
                     data: 'id_pose=' + $choix[1],
                     dataType: 'json',
                     type: 'POST',
                     async: false,
                     success: function(data) { 
                         switch (data.CODE_RETOUR) {
                             case 'OK':
                                 $('#id_pose').val(data.LISTE[0].id_pose);
                                 $('#maj_nom_pose').val(data.LISTE[0].nom_pose);
                                 $('#maj_photo_pose').attr('src','data:image/png;base64,' + data.LISTE[0].photo_pose);
                                 $('#liste').hide();
                                 form_select_filtre($('#select_sous_categorie').val(), 'MAJ');
                                 $('#maj_select_filtre').val(data.LISTE[0].id_filtre);
                                 $('#maj_nom_filtre').hide();
                                 $('#maj_pose').show();
                                 break;
                             case 'ANOMALIE':
                                 // GESTION DES ERREURS
                                 break;
                             default:
                                 // GESTION DES ERREURS
                                 break;
                         }
                     }
                 });
                 break;       
               case 'S':
                   $.ajax({
                     url: '../../php/suppression_pose.php',
                     data: 'id_pose=' + $choix[1],
                     dataType: 'json',
                     async: false,
                     success: function(data) { 
         
                         switch (data.CODE_RETOUR) {
                             case 'OK':
                                  liste_poses($('#select_sous_categorie').val());
                                 break;
                             case 'ANOMALIE':
                                 // GESTION DES ERREURS
                                 break;
                             default:
                                 // GESTION DES ERREURS
                                 break;
                         }
                     }
                 });
                 break; 
               default:
                 break;
             }
         })
         
         /* -------------------------------------------------------------------- */
         /* Liste des catégories / Génération du tableau                         */
         /* -------------------------------------------------------------------- */
         
         function liste_poses($parametre=1) {

           $.ajax({
             url: '../../php/lecture_id_pose.php',
             data : 'id_sous_categorie=' + $parametre,
             type : 'POST',
             dataType: 'json',
             async: false,
             success: function(data) { 
                 switch (data.CODE_RETOUR) {
                     case 'OK':
                       $ligne = '';
                       if (data.LISTE != null) {
                          
                        data.LISTE.forEach(element => {
                            $ligne  += `<tr>
                                          <th>${element.id_pose}</th>
                                          <td>${element.nom_filtre}</td>
                                          <td>${element.favori}</td>
                                          <td>${element.dt_maj_pose}</td>
                                          <td>${element.actif_pose}</td>
                                          <td class="col-1"><button type="button" class='btn btn-warning' id="M-${element.id_pose}">Modifier</button></td>
                                          <td class="col-1"><button type="button" class='btn btn-danger' id="S-${element.id_pose}">Désactiver</button></td>
                                       </tr>`;
                        });
                       }
         
                     $('#liste_poses').html($ligne);
           
                         break;
                     case 'ANOMALIE':
                         // GESTION DES ERREURS
                         break;
                     default:
                         // GESTION DES ERREURS
                         break;
                 }
             }
         });
         }
         
         /* -------------------------------------------------------------------- */
         /* Chargement d'une image à partir du poste.                            */
         /* -------------------------------------------------------------------- */
         
         var loadFile = function(event) {

            $erreur = '';

            if (event.target.files[0].size > 2000000)  {
               $erreur = 'Le fichier est trop volumineux';
            }

            if (event.target.files[0].size < 100000)  {
               $erreur = 'Le fichier est trop petit';
            }

            if ($erreur === '') {
               var output = document.getElementById('sunset');
               output.src = URL.createObjectURL(event.target.files[0]);
               output.onload = function() {
                  URL.revokeObjectURL(output.src) // free memory
               }
            } else {
               alert($erreur);
            }
         };

         var maj_loadFile = function(event) {
             var output = document.getElementById('maj_sunset');
             output.src = URL.createObjectURL(event.target.files[0]);
             output.onload = function() {
               URL.revokeObjectURL(output.src) // free memory
             }
         };

         /* -------------------------------------------------------------------- */
         /* Formatage de l'image catégorie au dimention  747 x 299               */
         /* -------------------------------------------------------------------- */
         
         function cropImg(){

             const canvas = document.getElementById('canvas');
             const ctx = canvas.getContext('2d');

             let image = document.getElementById('sunset');

             alert(image.width + ' ' + image.height);
             var coef = 500 /image.width;

             $x = document.getElementById("x").value;
             $x = parseInt($x) ;
         
             $y = document.getElementById("y").value;
             $y = parseInt($y)  ;
             
             alert(coef);
             alert(image.height * coef);
             ctx.drawImage(image, $x, $y,  image.width , image.height , 0, 0, image.width * coef, image.height * coef);
         
             var base64 = getBase64Image(document.getElementById("canvas"));
             document.getElementById("base64").innerHTML = base64; 
         }

         function maj_cropImg(){
             const canvas = document.getElementById('maj_canvas');
             const ctx = canvas.getContext('2d');
         
             let image = document.getElementById('maj_sunset');
             $x = document.getElementById("maj_x").value;
             $x = parseInt($x) ;
           
             $y = document.getElementById("maj_y").value;
             $y = parseInt($y)  ;
             
             ctx.drawImage(image, $x, $y,  747, 299, 0, 0, 747, 299);

             var base64 = maj_getBase64Image(document.getElementById("maj_canvas"));
             document.getElementById("maj_base64").innerHTML = base64; 
         }

         /* -------------------------------------------------------------------- */
         /* Génération en base 64 de l'image croppé                              */
         /* -------------------------------------------------------------------- */
         
         function getBase64Image(img) {
             var canvas = document.createElement("canvas");
             canvas.width = img.width;
             canvas.height = img.height;
             var ctx = canvas.getContext("2d");
             ctx.drawImage(img, 0, 0);
             var dataURL = canvas.toDataURL("image/png");
             ctx.restore();
             return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
         }

         function maj_getBase64Image(img) {
             var canvas = document.createElement("canvas");
             canvas.width = img.width;
             canvas.height = img.height;
             var ctx = canvas.getContext("2d");
             ctx.drawImage(img, 0, 0);
             var dataURL = canvas.toDataURL("image/png");
             ctx.restore();
             return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
         }     
 
         /* -------------------------------------------------------------------- */
         /* Liste des catégories / Génération du tableau                         */
         /* -------------------------------------------------------------------- */
         
         function form_select_categorie() {
           $.ajax({
             url: '../../php/liste_categorie.php',
             dataType: 'json',
             async: false,
             success: function(data) { 
                 switch (data.CODE_RETOUR) {
                     case 'OK':
                       $ligne = '';
                        data.LISTE.forEach(element => {
                           if ($ligne==='') {
                              $ligne  += `<option selected value="${element.id_categorie}">${element.nom_categorie}</option>`;
                           } else {
                              $ligne  += `<option value="${element.id_categorie}">${element.nom_categorie}</option>`;
                           }
                        });
         
                        $('#select_categorie').html($ligne);
           
                         break;
                     case 'ANOMALIE':
                         // GESTION DES ERREURS
                         break;
                     default:
                         // GESTION DES ERREURS
                         break;
                 }
             }
         });
         }

         /* -------------------------------------------------------------------- */
         /* Liste des sous catégories / Génération du tableau                    */
         /* -------------------------------------------------------------------- */
         
         function form_select_sous_categorie($id_categorie) {
           $.ajax({
             url: '../../php/liste_sous_categorie.php',
             data: 'id_categorie=' + $id_categorie,
             type : 'POST',
             dataType: 'json',
             async: false,
             success: function(data) { 
                 switch (data.CODE_RETOUR) {
                     case 'OK':
                       $ligne = '';
                       if (data.LISTE != null) {
                           data.LISTE.forEach(element => {
                              if ($ligne==='') {
                                 $ligne  += `<option selected value="${element.id_sous_categorie}">${element.nom_sous_categorie}</option>`;
                              } else {
                                 $ligne  += `<option value="${element.id_sous_categorie}">${element.nom_sous_categorie}</option>`;
                              }
                           });
                       }
                       $('#select_sous_categorie').html($ligne);
           
                         break;
                     case 'ANOMALIE':
                         // GESTION DES ERREURS
                         break;
                     default:
                         // GESTION DES ERREURS
                         break;
                 }
             }
         });
         }

         /* -------------------------------------------------------------------- */
         /* Liste des filtres en fonction de la sous catégorie                   */
         /* -------------------------------------------------------------------- */
         
         function form_select_filtre($id_sous_categorie, $mode) {
           $.ajax({
             url: '../../php/lecture_id_filtre.php',
             data: 'id_sous_categorie=' + $id_sous_categorie,
             type : 'POST',
             dataType: 'json',
             async: false,
             success: function(data) { 
                 switch (data.CODE_RETOUR) {
                     case 'OK':
                        $ligne  = `<option selected value="-1">Nouveau</option>`;

                        if (data.LISTE != null) {
                           data.LISTE.forEach(element => {
                              if ($ligne==='') {
                                 $ligne  += `<option selected value="${element.id_filtre}">${element.nom_filtre}</option>`;
                              } else {
                                 $ligne  += `<option value="${element.id_filtre}">${element.nom_filtre}</option>`;
                              }
                           });
                        }

                         if ($mode === 'AJOUT') {
                           $('#select_filtre').html($ligne);
                        } else {
                           $('#maj_select_filtre').html($ligne);
                         }
                         break;
                     case 'ANOMALIE':
                         // GESTION DES ERREURS
                         break;
                     default:
                         // GESTION DES ERREURS
                         break;
                 }
             }
         });
         }


      </script>
   </body>
</html>
