document.getElementById("dark-mode").onclick = function () {
    var body = document.getElementsByClassName("dark-mode-on");
    var element = document.getElementsByTagName("body");
    if (body.length > 0) {
        return element[0].classList.remove("dark-mode-on");
    }
    return element[0].classList.add("dark-mode-on");
};
//# sourceMappingURL=bootlight.js.map