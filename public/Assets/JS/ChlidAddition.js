document.addEventListener('DOMContentLoaded', function addChildForm() {
    var container = document.getElementById('children');
    var index = container.children.length;

    var prototype = container.getAttribute('data-prototype');
    var newForm = prototype.replace(/__name__/g, index);

    container.insertAdjacentHTML('beforeend', newForm);
})

