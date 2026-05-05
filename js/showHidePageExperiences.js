
let btnCorbeille = document.getElementById("btnCorbeille");
let btnListe = document.getElementById("btnListe");
let sectionCorbeille = document.getElementById("sectionCorbeilleExperiences");
let sectionListe = document.getElementById("sectionListesExperiences");

btnListe.style.display = "none";
sectionCorbeille.style.display = "none";

btnCorbeille.addEventListener("click", function() {
    btnListe.style.display = "block";
    btnCorbeille.style.display = "none";
    sectionListe.style.display = "none";
    sectionCorbeille.style.display = "block";

});

btnListe.addEventListener("click", function() {
    btnListe.style.display = "none";
    btnCorbeille.style.display = "block";
    sectionListe.style.display = "block";
    sectionCorbeille.style.display = "none";
});