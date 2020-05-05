let value = null;
function setLeaf(name) {
    value = localStorage.getItem("leaf");
    if (document.getElementById(value + 'Leaf') !== null) {
        document.getElementById(value + 'Leaf').classList.remove('active');
        document.getElementById(value + 'Page').classList.remove('active');
        document.getElementById(value + 'A').removeAttribute("aria-expanded");
    }
    localStorage.setItem("leaf", name);
    document.getElementById(name + 'Leaf').classList.add('active');
    document.getElementById(name + 'Page').classList.add('active');
    document.getElementById(name + 'A').setAttribute("aria-expanded", "true");
}
window.onload = function getLeaf() {
    value = localStorage.getItem("leaf");
    if (document.getElementById(value + 'Leaf') !== null) {
        document.getElementById(value + 'Leaf').classList.add('active');
        document.getElementById(value + 'A').setAttribute("aria-expanded", "true");
        document.getElementById(value + 'Page').classList.add('active');
    }
};
