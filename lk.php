<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <title>Личный кабинет пользователя</title>
  <style>
    span {
      font-size: 1.25rem;
      margin-left: 0.5rem;
    }

    p>span:nth-child(1) {
      font-weight: bold;
      color: crimson;
    }

    p>span:nth-child(2) {
      font-style: italic;
      font-weight: 700;
      color: brown;
    }
  </style>
</head>

<body>

  <div class="container mt-5">
    <h1>Личный кабинет пользователя</h1>
    <p><span>Id:</span> <span><?= $_SESSION["id"]; ?></span></p>

    <p>
    <p><span>Имя:</span>
      <span><?php echo $_SESSION["name"]; ?></span>
      <span class="edit-btn btn btn-danger"> Изменить</span>
      <span class="save-btn btn btn-info" hidden data-item="name"> Сохранить</span>
      <span class="cancel-btn btn btn-success" hidden>Отменить</span>
    </p>

    <p>
      <span>Фамилия:</span>
      <span><?php echo $_SESSION["lastname"]; ?></span>
      <span class="edit-btn btn btn-danger"> Изменить</span>
      <span class="save-btn btn btn-info" hidden data-item="lastname"> Сохранить</span>
      <span class="cancel-btn btn btn-success" hidden>Отменить</span>
    </p>

    <p><span>E-mail:</span> <span><?php echo $_SESSION["email"]; ?></span></p>
  </div>

  <script>
    let edit_buttons = document.querySelectorAll(".edit-btn");
    let save_buttons = document.querySelectorAll(".save-btn");
    let cancel_buttons = document.querySelectorAll(".cancel-btn");


    for (let i = 0; i < edit_buttons.length; i++) {
      let inputValue = edit_buttons[i].previousElementSibling.innerText;

      edit_buttons[i].addEventListener("click", () => {
        edit_buttons[i].previousElementSibling.innerHTML = `<input type="text" value="${inputValue}">`;
        edit_buttons[i].hidden = true;
        save_buttons[i].hidden = false;
        cancel_buttons[i].hidden = false;
      })
      cancel_buttons[i].addEventListener("click", () => {
        edit_buttons[i].previousElementSibling.innerText = inputValue;
        save_buttons[i].hidden = true;
        cancel_buttons[i].hidden = true;
        edit_buttons[i].hidden = false;
      })

      save_buttons[i].addEventListener("click", async () => {

        let newInputValue = edit_buttons[i].previousElementSibling.firstElementChild.value;
        edit_buttons[i].previousElementSibling.innerText = newInputValue;

        save_buttons[i].hidden = true;
        cancel_buttons[i].hidden = true;
        edit_buttons[i].hidden = false;

        let formData = new FormData();
        formData.append("value", newInputValue);
        formData.append('item', save_buttons[i].dataset.item);


        let response = await fetch('php/lk_obr.php', {
          method: 'POST',
          body: formData,
        });
      })
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>