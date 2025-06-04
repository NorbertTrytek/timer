function setEndNow() {
  console.log("Test zakończenia uruchomiony");
  start = new Date(localStorage.getItem("start") || new Date());
  end = new Date(Date.now() + 5000);
  localStorage.setItem("end", end);
  updateCountdown();
  messageEl.textContent = "⏭️ Odliczanie zakończy się za 5 sekund!";
}
