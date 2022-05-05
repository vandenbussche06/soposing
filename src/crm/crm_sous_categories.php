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
            <h1 class="text-center mt-5 mb-5">Gestion des sous catégories</h1>
            <br>
         </div>
         <div class="row">
            <button id='btn_ajout_sous_categeorie' type="button" class='btn btn-success mx-auto w-25'>Ajouter</button>
         </div>
         <div class="row">

            <div class='col-2 mx-auto'>
               <select id='select_categorie' class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                </select>
            </div>
         </div>

         <form>
                <div class="row">
                <table class="table mx-auto" style="width: 90%;">
                <thead>
                    <tr>
                        <th scope="col" class="col-1">#</th>
                        <th scope="col" class="col-3">Vignette</th>
                        <th scope="col" class="col-3">Sous Categorie</th>
                        <th scope="col" class="col-2">Date Maj</th>
                        <th scope="col" class="col-1">Actif</th>
                        <th scope="col" colspan="3" class="col-3">Actions</th>
                    </tr>
                </thead>
                <tbody id='liste_sous_categorie'>
                </tbody>
                </table>
            </div>
        </form>
      </div>

      
      <div id='ajout_sous_categorie' style='display:none'>
         <div class="row">
            <h1 class="text-center mt-5 mb-5">Ajouter d'une sous catégorie</h1>
            <br>
         </div>
         <div class="row">
            <div class='mx-auto' style="width: 90%;">
               <div class="mb-3">
                   <input id='id_categorie' type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" style='display:none'>
               </div>

               <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nom sous catégéorie</label>
                  <input id='nom_sous_categorie' type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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
                        <canvas id="canvas" width='747px' height='299px'>
                        </canvas>
                     </div>
                  </div>
               </div>
               <div class='row' style="display: none;">
                  <textarea id='base64'></textarea> 
               </div>
               <button id='btn_confirmer_ajout' class="btn btn-success">Confirmer</button>
               <button id='btn_annule_ajout' class="btn btn-warning">Annuler</button>
            </div>
         </div>
      </div>

      <div id='maj_sous_categorie' style='display:none'>
         <div class="row">
            <h1 class="text-center mt-5 mb-5">Modifier une sous catégorie</h1>
            <br>
         </div>
         <div class="row">
            <div class='mx-auto' style="width: 90%;">
              <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Id sous catégéorie</label>
                  <input id='id_sous_categorie' type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
               </div>
               <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nom sous catégéorie</label>
                  <input id='maj_nom_sous_categorie' type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
               </div>
               <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Photo</label>
                  <div class="col-3">
                     <img src='' id='maj_photo_sous_categorie' >
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

         liste_categorie();

         /* -------------------------------------------------------------------- */
         /* Affichage de la liste des sous catégories                            */
         /* -------------------------------------------------------------------- */
         
         liste_sous_categorie();
         
         const select_categorie = document.getElementById("select_categorie");
         select_categorie.addEventListener("change", function() {
            liste_sous_categorie($('#select_categorie').val());
         });

         /* -------------------------------------------------------------------- */
         /* Détection du bouton "Ajout Sous Catégorie"                           */
         /* -------------------------------------------------------------------- */
         
         const btn_ajout_sous_categeorie = document.getElementById("btn_ajout_sous_categeorie");
         btn_ajout_sous_categeorie.addEventListener("click", function() {
           $('#liste').hide();
           $('#id_categorie').val($('#select_categorie').val());
           $('#ajout_sous_categorie').show();
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
           $('#maj_sous_categorie').hide();
         });
         
         /* -------------------------------------------------------------------- */
         /* Détection du bouton "Confirmation de l'ajout de la catégorie"        */
         /* -------------------------------------------------------------------- */
         
         const btn_confirmer_ajout = document.getElementById("btn_confirmer_ajout");
         btn_confirmer_ajout.addEventListener("click", function() {
            $erreur = '';

            if ($('#nom_sous_categorie').val()==='') {
               $erreur = 'Le nom de la catégorie est obligatoire';
               alert($erreur);
            } 
            
            if ($('#base64').val()==='') {
               $erreur = "Vous n'avez pas croppé l'image ou l'image n'est pas chargés.";
               alert($erreur);
            } 

            if ($erreur === '') {

               $id_categorie = $('#id_categorie').val();
               $nom_sous_categorie = toTitles($('#nom_sous_categorie').val());

               $.ajax({
                        url: '../../php/ajout_sous_categorie.php',
                        data: 'id_categorie=' + $id_categorie + '&nom_sous_categorie=' + $nom_sous_categorie + '&photo_sous_categorie=' + $('#base64').val(),
                        type : 'POST',
                        dataType: 'json',
                        async: true,
                        success: function(data) { 
                              switch (data.CODE_RETOUR) {
                                 case 'OK':
                                    liste_sous_categorie();
                                    $('#liste').show();
                                    $('#ajout_sous_categorie').hide();
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
            if ($('#maj_nom_sous_categorie').val()==='') {
               $erreur = 'Le nom de la sous catégorie est obligatoire';
               alert($erreur);
            } 

            // L 'image est chargée mais n'est. pas croppée
            if (document.getElementById('maj_sunset').src !='' && $('#maj_base64').val()==='') {
               $erreur = "L'image n'est pas croppée !";
               alert($erreur);
            } 
            
           if ($erreur === '') {

            $nom_categorie = toTitles($('#maj_nom_sous_categorie').val());

            $.ajax({
                  url: '../../php/maj_sous_categorie.php',
                  data: 'id_sous_categorie=' + $('#id_sous_categorie').val() + '&nom_sous_categorie=' + $nom_categorie + '&photo_sous_categorie=' + $('#maj_base64').val(),
                  type : 'POST',
                  dataType: 'json',
                  async: true,
                  success: function(data) { 
                        switch (data.CODE_RETOUR) {
                           case 'OK':
                              liste_categorie();
                              $('#liste').show();
                              $('#maj_sous_categorie').hide();
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
                     url: '../../php/lecture_id_sous_categorie.php',
                     data: 'id_sous_categorie=' + $choix[1],
                     dataType: 'json',
                     async: false,
                     success: function(data) { 
                         switch (data.CODE_RETOUR) {
                             case 'OK':
                                 $('#id_sous_categorie').val(data.LISTE_SOUS_CATEGORIES[0].id_sous_categorie);
                                 $('#maj_nom_sous_categorie').val(data.LISTE_SOUS_CATEGORIES[0].nom_sous_categorie);
                                 $('#maj_photo_sous_categorie').attr('src','data:image/png;base64,' + data.LISTE_SOUS_CATEGORIES[0].photo_sous_categorie);
                                  $('#liste').hide();
                                  $('#maj_sous_categorie').show();
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
                     url: '../../php/suppression_sous_categorie.php',
                     data: 'id_sous_categorie=' + $choix[1],
                     dataType: 'json',
                     async: false,
                     success: function(data) { 
         
                         switch (data.CODE_RETOUR) {
                             case 'OK':
                                  liste_sous_categorie($('#select_categorie').val());
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
         
         function liste_sous_categorie($parametre=1) {

           $.ajax({
             url: '../../php/liste_sous_categorie.php',
             data : 'id_categorie=' + $parametre,
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
                                          <th>${element.id_sous_categorie}</th>
                                          <td><img style='width:60px' src="data:image/png;base64,${element.photo_sous_categorie}"/></td>
                                          <td>${element.nom_sous_categorie}</td>
                                          <td>${element.dt_maj_sous_categorie}</td>
                                          <td>${element.actif_sous_categorie}</td>
                                          <td class="col-1"><button type="button" class='btn btn-warning' id="M-${element.id_sous_categorie}">Modifier</button></td>
                                          <td class="col-1"><button type="button" class='btn btn-danger' id="S-${element.id_sous_categorie}">Désactiver</button></td>
                                       </tr>`;
                        });
                       }
         
                     $('#liste_sous_categorie').html($ligne);
           
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

            if (event.target.files[0].size > 1000000)  {
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
             ctx.clearRect(0, 0, canvas.width, canvas.height);

             let image = document.getElementById('sunset');
             $x = document.getElementById("x").value;
             $x = parseInt($x) ;
         
             $y = document.getElementById("y").value;
             $y = parseInt($y)  ;
             
             ctx.drawImage(image, $x, $y,  747, 299, 0, 0, 747, 299);
         
             var base64 = getBase64Image(document.getElementById("canvas"));
             document.getElementById("base64").innerHTML = base64; 
         }

         function maj_cropImg(){
             const canvas = document.getElementById('maj_canvas');
             const ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);

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
         /* Convertion du nom de la catégorie.                                   */
         /* -------------------------------------------------------------------- */

         function toTitles(s){ 
            return s.replace(/\w\S*/g, function(t) { return t.charAt(0).toUpperCase() + t.substr(1).toLowerCase(); }); 
         }

         /* -------------------------------------------------------------------- */
         /* Liste des catégories / Génération du tableau                         */
         /* -------------------------------------------------------------------- */
         
         function liste_categorie() {
           $.ajax({
             url: '../../php/liste_categorie.php',
             dataType: 'json',
             type : 'POST',
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

      </script>
   </body>
</html>
