window.onload = function addInput()
{
    var form = document.getElementById('contactForm');
    var text = document.createElement('div');
    text.innerHTML = '<input type="text" name="first_name" value="" class="contact-first-name" />';
    form.appendChild(text);
};
