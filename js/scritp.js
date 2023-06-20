var modal = document.getElementById('notification-modal');
var icon = document.querySelector('.notification-icon');
var closeButton = document.getElementById('close');
var notificationList = document.getElementById('notification-list');


if (icon !== null) {
    icon.addEventListener('click', function () {
        modal.style.display = 'block';
    });
}


if (closeButton !== null) {
    closeButton.addEventListener('click', function () {
        modal.style.display = 'none';
    });
}


function addNotification(notification, idNotificacion) {
    var listItem = document.createElement('li');
    listItem.classList.add('notification-item');
    listItem.textContent = notification;

    if (notification.includes('ha aceptado tu oferta') || notification.includes('ha rechazado tu oferta')) {

        var finishButton = document.createElement('button');
        finishButton.classList.add('notification-button');
        finishButton.textContent = 'Terminar';
        finishButton.addEventListener('click', function () {
        
            $.ajax({
                url: 'index.php?controlador=producto&action=limpiar_notificacion',
                success: function () {
                
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            });

            modal.style.display = 'none';
        });


        listItem.appendChild(finishButton);
    } else {
        var acceptButton = document.createElement('button');
        acceptButton.classList.add('notification-button');
        acceptButton.textContent = 'Aceptar';
        acceptButton.addEventListener('click', function () {
            window.location.href = 'index.php?controlador=producto&action=vender_instrumento';
            modal.style.display = 'none';
        });

        var deleteButton = document.createElement('button');
        deleteButton.classList.add('notification-button');
        deleteButton.textContent = 'Eliminar';
        deleteButton.addEventListener('click', function () {
            window.location.href = 'index.php?controlador=producto&action=noVender_instrumento';
            modal.style.display = 'none';
        });

        listItem.appendChild(acceptButton);
        listItem.appendChild(deleteButton);
    }

    notificationList.appendChild(listItem);
}


var notificationText = document.getElementById('notificacionText');
var notificationId = document.getElementById('notificacionId');

if (notificationText !== null && notificationId !== null) {
    var notificationTextValue = notificationText.value;
    var notificationIdValue = notificationId.value;
    addNotification(notificationTextValue, notificationIdValue);
}


document.addEventListener('DOMContentLoaded', function () {
    var folder1 = document.getElementById('folder1');
    var folder2 = document.getElementById('folder2');
    var content1 = document.getElementById('content1');
    var content2 = document.getElementById('content2');

    if (folder1 && content1) {
        folder1.addEventListener('click', function () {
            content1.style.display = 'block';
            content2.style.display = 'none';
        });
    }

    if (folder2 && content2) {
        folder2.addEventListener('click', function () {
            content1.style.display = 'none';
            content2.style.display = 'block';
        });
    }
});

function openModal() {
    var modal = document.getElementById("chatModal");
    modal.style.display = "block";
}


function closeModal() {
    var modal = document.getElementById("chatModal");
    modal.style.display = "none";
}


function sendMessage() {
    var messageInput = document.getElementById("messageInput");
    var message = messageInput.value;

    if (message.trim() !== "") {
        var chatMessages = document.getElementById("chatMessages");
        var li = document.createElement("li");
        li.textContent = message;
        chatMessages.appendChild(li);
        messageInput.value = "";
    }
}