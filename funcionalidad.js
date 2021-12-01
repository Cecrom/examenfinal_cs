// DIVS Y CONTENIDO DE LA WEB

var diAmgigoYEntra = new Audio('/examenfinal_cs/recursos/diamigoyentra.mp3');
var amigo = new Audio('/examenfinal_cs/recursos/amigo.mp3');
var divMostrarGrupos = document.getElementById("mostrarGrupos");
var elegirJuego = document.getElementById("divElegirJuego");
var presentacion = document.getElementById("presentacion");
var imagenInicio = document.getElementById("divImagenInicio");
var divAvance = document.getElementById("avance");
var cabecera = document.getElementById("cabecera");
var general = document.getElementById("general");
var final = document.getElementById("final");

// VARIABLES DEL JUEGO

var poemas = false;
var traducciones = false;
var contraseña = false;

// FUNCIONES DE FUNCIONABILIDAD DE LA WEB

function inicio() {
    alert("Al clickar, te llevaría a una web para hacer el pago y redirigirte al inicio del juego. En esta ocasión, te redirigimos diréctamente al juego.");
    cabecera.style.display = "none";
    presentacion.style.display="none";
    elegirJuego.style.display = "none";
    imagenInicio.style.display = "block";
    diAmgigoYEntra.play();
    diAmgigoYEntra.addEventListener("ended",function(){
        alert("Pídele ayuda a Gandalf haciendo click en la imagen, y preparáos para el desafío.");
    })
}

function proximamente() {
    alert("Juego no disponible actualmente");
}

function entrarAJugar() {
    amigo.play();
    amigo.addEventListener('ended', function () {
        document.location.href = "/examenfinal_cs/iniciocamarademazarbul.php";
    })
}

function validar() {
    var nombre = document.getElementById("nombreGrupo").value;
    var participantes = document.getElementById("numeroParticipantes").value;

    if (nombre.length > 20) {
        alert("El nombre del grupo no debe exceder los 20 caracteres de longitud");
        return false;
    } else if (participantes.toString().length > 1) {
        alert("No pueden participar más de 9 personas en la scape room");
        return false;
    } else {
        return true;
    }
}

function validarAdmin() {
    var usuario = document.getElementById('usuario').value;
    var contraseña = document.getElementById('contraseña').value;

    if (usuario != "" && contraseña != "") {
        return true;
    } else {
        alert("Rellene ambos campos");
        return false;
    }
}

// FUNCIONES DEL JUEGO

function libro() {
    divAvance.innerHTML = "";
    divAvance.innerHTML = "<p>Se trata de un libro de cuentas antiguo... Tan antiguo que no eres capaz de entender estas viejas runas enanas</p>";
    if (traducciones) {
        divAvance.innerHTML = "";
        divAvance.innerHTML += "<p>Gracias al pergamino de traducciones, reconoces diferentes transacciones que pueden leerse sin mucha dificultad. Una de ellas habla de una caja y la contraseña para abrirla</p>";
        contraseña = true;
    }
}

function caja() {
    divAvance.innerHTML = "";
    if (contraseña) {
        divAvance.innerHTML = "<p>Parece que la caja responde a la contraseña que dices en alto.</p><p>Al abrirse descubres un antiguo poemario, tan antiguo que usa runas enanas ancestrales</p>";
        if (traducciones) {
            divAvance.innerHTML += "<p>Gracias al pergamino con traducciones, distingues algunos poemas.</p><p>Incluso hay poemas mortuorios</p>";
            poemas = true;
        } else {
            divAvance.innerHTML += "<p>Desgraciadamente tu enano es demasiado moderno como para entenderlos.</p>"
        }
    } else {
        divAvance.innerHTML = "<p>Vaya, está protegida por la magia enana, como la puerta de Moria, necesitará una contraseña para abrirla";
    }

}

function ventana() {
    divAvance.innerHTML = "";
    divAvance.innerHTML = "<p>Claro, no podía ser tan fácil... Es demasaido pequeña y está demasiado alta...</p><p>Bueno, parece que alguien intentó usar esta salida hace mucho tiempo y se acabó abriendo la cabeza contra el suelo</p><p>Ya solo queda su bolsa. Eh, eso parece un pergamino. Parecen ser traducciones de antiguas runas enanas a las modernas</p>";
    traducciones = true;
}

function tumba() {
    divAvance.innerHTML = "";
    divAvance.innerHTML = "<p>Hay una inscripción en su lecho: 'Aquí yace Balin, último rey de Moria. Aquellos que le rindan respeto podrán salir de su hogar en paz.'</p>";
    if (poemas) {
        divAvance.innerHTML += "<p>Podrías leer uno de los poemas mortuorios   <form method='post'><input type='submit' name='salir' value='Leer'></form></p>";
    }
}

function validarFinal() {
    var respuesta = document.getElementById("pronunciar").value;
    if (respuesta.toLowerCase() == "gracias") {
        alert("La roca cruje, se queja y quiebra. Se va abriendo lentamente, dejando entrar poco a poco la luz del exterior.");
        return true;
    } else {
        alert("Nada sucede");
        return false;
    }
}