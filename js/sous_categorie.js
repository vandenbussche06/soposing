   
    $(document).ready(function() {  
 
      document.onreadystatechange = function() {
            if (document.readyState !== "complete") {
                document.querySelector(
                  "body").style.visibility = "hidden";
                document.querySelector(
                  "#loader").style.visibility = "visible";
            } else {
                document.querySelector(
                  "#loader").style.display = "none";
                document.querySelector(
                  "body").style.visibility = "visible";
            }
        };
        
        //* ----------------------------------------------------------------------------------------------------
        //* Test si IndexDB est supporté par le navigateur
        //* ----------------------------------------------------------------------------------------------------

        if (!window.indexedDB) {
            console.log(`IndexedDB non supporté par le navigateur`);
            window.location.href = 'anomalie_indexeddb.html';
        } else {
            console.log(`IndexedDB supporté par le navigateur`);                 
        }

        //* ----------------------------------------------------------------------------------------------------
        //* Ouverture de la base de données SO POSING
        //*
        //* La méthode open() renvoie un objet de requête qui est une instance de l' IDBOpenDBRequest interface.
        //* ----------------------------------------------------------------------------------------------------

        const request = indexedDB.open('SOPOSING', 1);

        //* Détection d'une erreur sur l'ouverture de la base de données
        request.onerror = (event) => {
            console.error(`Erreur sur l'ouverture : ${event.target.errorCode}`);
        };

        //* La base de données est ouverte
        request.onsuccess = (event) => {

          let db = event.target.result;

          nro_categorie = parseInt(sessionStorage.getItem("id_categorie"));

          getCategorieById(db, nro_categorie)
          .then(function(result){     
            $('#TITRE').html(result.nom_categorie.toUpperCase()); 

            getSousCategorieByIdCategorie(db, result.id_categorie)
            .then(function(result){ 
                let $ligne = ''; 

                result.forEach(element => {
                  $ligne += `<div id="${element.id_sous_categorie}" class='sous_categorie' style="background-size: contain ! important; background: url(data:image/png;base64,${element.photo_sous_categorie}) no-repeat center;"> 
                                  <div id="${element.id_sous_categorie}" class='overlay_light'></div>    
                                  <div id="${element.id_sous_categorie}" class='titre'> ${element.nom_sous_categorie}</div> 
                              </div>`;
                });
                document.getElementById("BLK_SS_CATEGORIE").innerHTML = $ligne;
            })
            .catch(function(result){  
                    let $ligne = '';
                    console.log('KO* ' + result);
            })
          })
          .catch(function(result){   
            console.log('KO');
          });
        };
  
    //* ----------------------------------------------------------------------------------------------------
    //* Accès aux informations "categorie" par le numéroi d'index
    //*
    //* Paramètres : nom de la base de données et id de la catégorie
    //* ----------------------------------------------------------------------------------------------------

    async function getCategorieById(db, id){
        return new Promise(function(resolve, reject){
          
            const txn   = db.transaction('categorie', 'readonly');
            const store = txn.objectStore('categorie');
        
            let query   = store.get(id);
        
            query.onsuccess = (event) => {
                if (!event.target.result) {
                    console.log(`Categorie ${id} not found`);
                } else {
                    resolve(event.target.result);
                 }
            };
        
            query.onerror = (event) => {
                reject(event.target.errorCode);
            }
        });
    }

    //* ----------------------------------------------------------------------------------------------------
    //* Accès aux informations "categorie" par le numéroi d'index
    //*
    //* Paramètres : nom de la base de données et id de la catégorie
    //* ----------------------------------------------------------------------------------------------------

    async function getSousCategorieByIdCategorie(db, id_categorie){
        return new Promise(function(resolve, reject){
            liste = [];

            const txn = db.transaction('sous_categorie', 'readonly');
            const store = txn.objectStore('sous_categorie');

            // return the result object on success
            var request = store.openCursor();
            request.onsuccess = function(event) {
              var cursor = event.target.result;
              if(cursor) {
                 if ((cursor.value.id_categorie === id_categorie) && (cursor.value.actif_sous_categorie === 1)) {

                  let sous_categorie = {
                      id_sous_categorie : cursor.value.id_sous_categorie,
                      nom_sous_categorie : cursor.value.nom_sous_categorie,
                      photo_sous_categorie : cursor.value.photo_sous_categorie,
                      id_categorie : cursor.value.id_categorie,
                      actif : cursor.value.actif_sous_categorie,
                  }
                  liste.push(sous_categorie)
                }
                cursor.continue();
              } else {
                console.table(liste);
                resolve(liste);
              }
            };

        });
    }

        //* ----------------------------------------------------------------------------------------------------
        //* Détection du click sur la catégorie
        //* ----------------------------------------------------------------------------------------------------

        document.getElementById('BLK_SS_CATEGORIE').onclick = function(event) {          
          sessionStorage.setItem("id_sous_categorie",event.target.id);
          window.location = 'pose.html';
        }

        //* ----------------------------------------------------------------------------------------------------
        //* Détection du click sur le bouton BACK
        //* ----------------------------------------------------------------------------------------------------

        document.getElementById('BTN_BACK').onclick = function(event) {
          window.location = 'categorie.html';
        }

    });
