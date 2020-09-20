//callback = pasarle una funcion a otra (en este caso 'inicio')
/*
window.addEventListener("load", ()=>{
    document.getElementById("lblNombre").addEventListener(
        "click", //avisarClick - puntero a la funcion comentada mas abajo
        /*
        function (){ //funcion anonima - para cuando no se necesita volver a llamarla
            alert("Hiciste click!");
        }
        
        //miFuncion //las funciones se pueden guardar en funciones (puntero a funcion)
        ()=>{ //arrrow function - idem anonima, sin escribir function
        alert("Hiciste click!");
        }
    );  
}); 
*/
/*
function avisarClick(){
    alert("Hiciste click!");
}
*/
/*
let miFuncion = function(){
    alert("Hiciste click!");
}
*/


window.addEventListener("load",()=>{

    //anula el comportamiento nativo del submit
    let formulario = document.getElementById("frm1");
    formulario.addEventListener("submit", (e)=>{ //e= objeto evento (IDEM EJEMPLO A mas abajo)
        e.preventDefault();
        alert("No vamos a ningún lado!");
    });


});

/*      EJEMPLO A
function miFuncion(e){
    e.preventDefault();
}
*/