$(document).on('ready', function() {

    localStorage.setItem('btn_favori', 0);

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
        nro_sous_categorie = sessionStorage.getItem("id_sous_categorie");

        getSousCategorieById(db, nro_sous_categorie)
        .then(function(result){     
        $('#titre').html(result.nom_sous_categorie.toUpperCase()); 

        getFiltreById(db, nro_sous_categorie)
        .then(function(result){   
            $ligne = '';
            $indice = 1;
            $('#liste_filtres').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3
            });

            var id_filtre_selection = localStorage.getItem('id_filtre_selection');

            result.forEach(element => {
                if ($indice === 1) {
                    id_filtre = element.id_filtre
                }

                $ligne += `<div style='height:50px;'>
                                <a id="${element.id_filtre}" class="pose">&nbsp;&nbsp;${element.nom_filtre}&nbsp;&nbsp;</a>
                           </div>`;

                $('#liste_filtres').slick('slickAdd', $ligne);
            });

            liste_poses(id_filtre, 0) 
            
        })
        .catch(function(result){   
            console.log('KOX' + result);
        });
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

async function getSousCategorieById(db, id){
    return new Promise(function(resolve, reject){
        
        const txn   = db.transaction('sous_categorie', 'readonly');
        const store = txn.objectStore('sous_categorie');

        var id_num = parseInt(id);
        let query   = store.get(id_num);
    
        query.onsuccess = (event) => {
            if (typeof event.target.result === 'object') {
                resolve(event.target.result);                    
            } else {
                reject("Sous categorie not found");     
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

async function getPoseById(db, id_filtre){
    return new Promise(function(resolve, reject){
        
        const txn   = db.transaction('pose', 'readonly');
        const store = txn.objectStore('pose');

        var liste = [];  
        var request = store.openCursor();
        request.onsuccess = function(event) {
            var cursor = event.target.result;
            if(cursor) {
                if (parseInt(id_filtre) === parseInt(cursor.value.id_filtre)) {
                let pose = {
                    id_pose           : cursor.value.id_pose,
                    id_sous_categorie : cursor.value.id_sous_categorie,
                    favori            : cursor.value.favori,
                    photo_pose        : cursor.value.photo_pose 
                }
                liste.push(pose);
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
//* Accès aux informations "categorie" par le numéroi d'index
//*
//* Paramètres : nom de la base de données et id de la catégorie
//* ----------------------------------------------------------------------------------------------------

async function getFiltreById(db, nro_sous_categorie){
    return new Promise(function(resolve, reject){
    
        const txn   = db.transaction('filtre', 'readonly');
        const store = txn.objectStore('filtre');
        
        var liste_filtre = [];
        var request = store.openCursor();
        request.onsuccess = function(event) {
            var cursor = event.target.result;
            if(cursor) {
                 if (parseInt(cursor.value.id_sous_categorie) == parseInt(nro_sous_categorie)) {
                    let filtre = {
                        id_filtre         : cursor.value.id_filtre,
                        id_sous_categorie : cursor.value.id_sous_categorie,
                        nom_filtre        : cursor.value.nom_filtre,
                        actif_filtre      : cursor.value.actif_filtre 
                    }
                    liste_filtre.push(filtre);
                }
                cursor.continue();
            } else {
            console.table(liste_filtre);
            resolve(liste_filtre);
            }
        };
    });
}

    //* ----------------------------------------------------------------------------------------------------
    //* Détection du click sur un filtre
    //* ----------------------------------------------------------------------------------------------------

    document.getElementById('liste_filtres').onclick = function(event) {

        localStorage.setItem('id_filtre_selection', event.target.id);
        var btn_favori = localStorage.getItem('btn_favori');

        var id_filtre_selection = localStorage.getItem('id_filtre_selection');
        liste_poses(id_filtre_selection, btn_favori); 
    }

    //* ----------------------------------------------------------------------------------------------------
    //* Détection du click sur le bouton BACK
    //* ----------------------------------------------------------------------------------------------------

    document.getElementById('btn_back').onclick = function(event) {
        window.location = 'sous_categorie.html';
    }

    //* ----------------------------------------------------------------------------------------------------
    //* Détection du click sur le bouton HOME
    //* ----------------------------------------------------------------------------------------------------

    document.getElementById('btn_home').onclick = function(event) {
        window.location = 'index.html';
    }

    //* ----------------------------------------------------------------------------------------------------
    //* Détection du click sur le bouton FAVORI
    //* ----------------------------------------------------------------------------------------------------

    document.getElementById('btn_favori').onclick = function(event) {
 
        if (localStorage.getItem("btn_favori") === '1') {
            localStorage.setItem('btn_favori', 0);
            document.getElementById("btn_favori").src="images/coeur_off.png";
        } else {
            localStorage.setItem('btn_favori', 1);
            document.getElementById("btn_favori").src="images/coeur_on.png";
        }

        liste_poses(id_filtre, 1)

    }

    //* ----------------------------------------------------------------------------------------------------
    //* Détection du click sur le bouton Ajout d'une pose en favori
    //* ----------------------------------------------------------------------------------------------------

    document.getElementById('liste_poses').onclick = function(event) {
        var myArray = event.target.id.split("-");
     
        sessionStorage.setItem("id_favori",event.target.id);

        switch (myArray[0]) {
            case 'favori':
                const request = indexedDB.open('SOPOSING', 1);
                request.onsuccess = (event) => {          
                    let db = event.target.result;

                    //* Ouverture de la table : date_synchronisation
                    const txn = db.transaction('pose', 'readwrite');
                    const store = txn.objectStore('pose');

                    // get the index from the Object Store
                    const index = store.index('id_pose');

                    // query by indexes
                    let query = index.get(parseInt(myArray[1]));

                    //* Enregistrement trouvé
                    query.onsuccess = ()=> {

                        //* Initialisation de l'objet synchro avec la date du jour
                        const pose = query.result;
                        pose.favori = !pose.favori;

                        // Mise à jour de l'enregostrement avec la clé en paramètre
                        const updateRequest = store.put(pose);

                        updateRequest.onsuccess = () => {
                            console.log(`Mise à jour de la pose  ${updateRequest.result}`);
                            id_favori = sessionStorage.getItem("id_favori");
                            pose.favori ? document.getElementById(id_favori).src="images/coeur_on.png" : document.getElementById(id_favori).src="images/coeur_off.png";
                        }

                        updateRequest.onerror = () => {
                            console.log(`Erreur sur la mise à jour de la date de synchronisation ${updateRequest.error}`);
                        }
                    }

                    query.onerror = (event) => {
                        console.log('erreur ' + event.target.errorCode);
                    }
                }
                break;
            case 'used':
                alert('CROIX');
            default:
                break;
        }

    }

    //* ----------------------------------------------------------------------------------------------------
    //* Liste des poses
    //* ----------------------------------------------------------------------------------------------------

    function liste_poses(id_filtre, id_favori) {
        const request = indexedDB.open('SOPOSING', 1);
        request.onsuccess = (event) => {
        
        let db = event.target.result;

        var id_filtre_selection = localStorage.getItem('id_filtre_selection');
        $('#liste_poses').html('');

        getPoseById(db,id_filtre_selection)
            .then(function(result){   
                $ligne = '';
                result.forEach(element => {
 
                    if (element.favori == 1) {
                        $ligne += `<div style='position:relative'>
                            <img id="favori-${element.id_pose}" style='position: absolute; left:0px; top:0px; padding:15px 15px' src='images/coeur_on.png ' />
                            <img id="used-${element.id_pose}" style='position: absolute; right:0px; top:0px; padding:15px 15px' src='images/croix.png ' />

                             <img style='width:100%' src='data:image/png;base64,${element.photo_pose}' />
                        </div>`;
                    } else {
                        $ligne += `<div style='position:relative'> 
                            <img id="favori-${element.id_pose}" style='position: absolute; left:0px; top:0px; padding:15px 15px' src='images/coeur_off.png ' />
                            <img id="used-${element.id_pose}" style='position: absolute; right:0px; top:0px; padding:15px 15px' src='images/croix.png ' />
                            <img style='width:100%' src='data:image/png;base64,${element.photo_pose}' />
                        </div>`;   
                    }
                });

                $('#liste_poses').html($ligne);
            })
            .catch(function(result){   
                console.log('KOXx' + result);
            });
        }
    }
});