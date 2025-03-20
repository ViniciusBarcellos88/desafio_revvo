let currentIndex = 0;
const carouselItems = document.querySelectorAll('.carousel-item');
const totalItems = carouselItems.length;

function showNextItem() {
    currentIndex = (currentIndex + 1) % totalItems;
    updateCarousel();
}

function showPrevItem() {
    currentIndex = (currentIndex - 1 + totalItems) % totalItems;
    updateCarousel();
}

function updateCarousel() {
    const offset = -currentIndex * 100;
    document.querySelector('.carousel-inner').style.transform = `translateX(${offset}%)`;
}

document.querySelector('.carousel-next').addEventListener('click', showNextItem);
document.querySelector('.carousel-prev').addEventListener('click', showPrevItem);

setInterval(showNextItem, 5000);

function toggleMenu() {
    const menu = document.getElementById("profileMenu");
    menu.classList.toggle("active");
}

document.addEventListener("click", function (event) {
    const profile = document.querySelector(".profile");
    const menu = document.getElementById("profileMenu");

    if (!profile.contains(event.target)) {
        menu.classList.remove("active");
    }
});

function fecharModalBoasVindas() {
    document.getElementById('modalBoasVindas').style.display = 'none';
    localStorage.setItem("modalExibido", "true");
}

// if (!localStorage.getItem("modalExibido"))
{
    document.getElementById('modalBoasVindas').style.display = 'flex';
}

document.getElementById('modalBoasVindas').addEventListener('click', (event) => {
    if (event.target === document.getElementById('modalBoasVindas')) {
        fecharModalBoasVindas();
    }
});

function adicionarCurso(nome, descricao) {
    const cursosContainer = document.querySelector(".cursos-container");

    const novoCard = document.createElement("div");
    novoCard.classList.add("curso-card");

    novoCard.innerHTML = `
        <div class="menu-opcoes">
            <button class="btn-opcoes" onclick="toggleOpcoes(this)">&#8942;</button>
            <div class="opcoes-dropdown">
                <a href="#" class="opcao" onclick="editarCurso(this)">Editar</a>
                <a href="#" class="opcao" onclick="excluirCurso(this)">Excluir</a>
            </div>
        </div>
        <img src="images/cursos/card.jpg" alt="${nome}">
        <div class="curso-info">
            <h3>${nome}</h3>
            <p>${descricao}</p>
            <a href="pagina_do_curso.php" class="btn">Ver Curso</a>
        </div>
    `;

    cursosContainer.insertBefore(novoCard, cursosContainer.lastElementChild);
}

function toggleOpcoes(button) {
    const menu = button.parentElement;
    menu.classList.toggle("active");
}

document.addEventListener("click", function (event) {
    const menus = document.querySelectorAll(".menu-opcoes");
    menus.forEach(menu => {
        if (!menu.contains(event.target)) {
            menu.classList.remove("active");
        }
    });
});

let cursoIdParaExcluir = null;

function abrirModalExcluir(id) {
    cursoIdParaExcluir = id;
    document.getElementById('modalExcluir').style.display = 'flex';
}

function fecharModalExcluir() {
    document.getElementById('modalExcluir').style.display = 'none';
    cursoIdParaExcluir = null;
}

function confirmarExclusao() {
    if (cursoIdParaExcluir) {
        window.location.href = `excluir_curso.php?id=${cursoIdParaExcluir}`;
    }
}

window.addEventListener("scroll", function () {
    const menus = document.querySelectorAll(".menu-opcoes");
    menus.forEach(menu => {
        menu.classList.remove("active");
    });
});

window.addEventListener("scroll", function () {
    const menus = document.querySelectorAll(".profile-menu");
    menus.forEach(menu => {
        menu.classList.remove("active");
    });
});