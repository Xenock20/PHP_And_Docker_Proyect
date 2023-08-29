const saveNameButton = document.getElementById("saveNameButton");
const playerNameInput = document.getElementById("playerNameInput");
const phpLink = document.getElementById("phpLink");
const namePlayer = document.getElementById("namePlayer");
const modal = document.getElementById("modal");
const openModalButton = document.getElementById("openModal");

// Abre el modal cuando se hace clic en el botón
openModalButton.addEventListener("click", () => {
  playerNameInput.value = "";
  modal.style.display = "flex";
});

// Guarda el nombre y habilita los enlaces
saveNameButton.addEventListener("click", () => {
  let playerName = playerNameInput.value;

  if (playerName.length === 0) {
    playerName = "Player";
  }

  modal.style.display = "none";
  phpLink.href = `./pages/PHP/gameOriginal.php?player=${playerName}`;
  namePlayer.textContent = playerName;
});
