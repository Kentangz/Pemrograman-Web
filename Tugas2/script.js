const taskInput = document.getElementById("task");
const taskList = document.getElementById("taskList");

function addTask() {
  const taskText = taskInput.value;
  if (taskText.trim() !== "") {
    const li = document.createElement("li");
    li.innerHTML = `
      <span>${taskText}</span>
      <button class="edit" onclick="editTask(this.parentElement)"><i class="fas fa-edit"></i></button>
      <button class="delete" onclick="deleteTask(this.parentElement)"><i class="fas fa-trash"></i></button>
    `;

    taskList.appendChild(li);

    taskInput.value = "";
  }
}

function editTask(taskItem) {
  const span = taskItem.querySelector("span");
  const updatedTask = prompt("Edit tugas:", span.textContent);

  if (updatedTask !== null) {
    span.textContent = updatedTask;
  }
}

function deleteTask(taskItem) {
  taskItem.remove();
}