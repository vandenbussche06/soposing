
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

        let $ligne = '';
        let db = event.target.result;
        sessionStorage.setItem("db",db);

        getAllCategorie(db)
        .then(function(result){               
            result.forEach(categorie => {
            if (parseInt(categorie.actif) === 1) {
            $ligne += ` <div id="${categorie.id_categorie}" class='categorie' style="background-size: contain ! important; background: url(data:image/png;base64,${categorie.photo_categorie}) no-repeat center;"> 
                            <div id="${categorie.id_categorie}" class='overlay_light'></div>    
                            <div id="${categorie.id_categorie}" class='categorie titre'> ${categorie.nom_categorie}</div> 
                        </div>`;
            } else {
            $ligne += `<div class='categorie overlay' style="background-size: contain ! important; background: url(data:image/png;base64,${categorie.photo_categorie}) no-repeat center;">    
                            <div class='categorie titre'> ${categorie.nom_categorie}</div> 
                        </div>`;
            }

            })
            document.getElementById("BLK_MENU").innerHTML = $ligne;
        })
        .catch(function(result){   
        console.log('KO');
        });
    };

    //* ----------------------------------------------------------------------------------------------------
    //* Liste des catégories
    //*
    //* Paramètres : nom de la base de données  
    //* ----------------------------------------------------------------------------------------------------

    async function getAllCategorie(db) {
        return new Promise(function(resolve, reject){
            const txn = db.transaction('categorie', "readonly");
            const objectStore = txn.objectStore('categorie');
            liste = [];

            objectStore.openCursor().onsuccess = (event) => {
            let cursor = event.target.result;
            if (cursor) {
                let contact = cursor.value;
                //console.log(contact);
                liste.push(contact);
                // continue next record
                cursor.continue();
            } else {
                resolve(liste);
            }
            };
        });
    };

    //* ----------------------------------------------------------------------------------------------------
    //* Détection du click sur la catégorie
    //* ----------------------------------------------------------------------------------------------------

    document.getElementById('BLK_MENU').onclick = function(event) {          
        if (parseInt(event.target.id) > 0){
        sessionStorage.setItem("id_categorie",event.target.id);
        window.location = 'sous_categorie.html';
        } 
    }
    
    //* ----------------------------------------------------------------------------------------------------
    //* Détection du click sur le bouton BACK
    //* ----------------------------------------------------------------------------------------------------

    document.getElementById('BTN_BACK').onclick = function(event) {
        window.location = 'index.html';
    }

});
