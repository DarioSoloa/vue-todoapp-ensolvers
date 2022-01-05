<template>
  <div class="container">
    <router-link to="/addTodo" class="btn btn-success"
      >Add new To-do</router-link
    >
    <br /><br />
    <div class="card">
      <div class="card-header">To-do list</div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th>Completed</th>
              <th>Tasks</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="todo in todos" :key="todo.id">
              <td>
                <input
                  type="checkbox"
                  @change="changeStatus(todo.id, todo.completed)"
                  :checked="todo.completed == true"
                />
              </td>
              <td>
                <div :class="{ completed: todo.completed == true }">
                  {{ todo.title }}
                </div>
              </td>
              <td>
                <div class="btn-group" role="group" aria-label="">
                  <router-link
                    :to="{ name: 'EditTodo', params: { id: todo.id } }"
                    class="btn btn-info"
                    >Edit</router-link
                  >
                  <button
                    type="button"
                    v-on:click="removeTodo(todo.id)"
                    class="btn btn-danger"
                  >
                    Remove
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      todos: [],
    };
  },
  created: function () {
    this.fetchTodos();
  },
  methods: {
    fetchTodos() {
      fetch("http://localhost/todos/")
        .then((response) => response.json())
        .then((dataResponse) => {
          console.log(dataResponse);
          this.todos = [];
          this.todos = dataResponse;
        })
        .catch(console.log);
    },
    removeTodo(id) {
      console.log(id);
      fetch("http://localhost/todos/?remove=" + id)
        .then((response) => response.json())
        .then((dataResponse) => {
          console.log(dataResponse);
          window.location.href = "todoList";
        })
        .catch(console.log);
    },
    changeStatus(id, status) {
      if (status == false) {
        var realStatus = true;
      } else if (status == true) {
        realStatus = false;
      }
      var dataSend = {
        id: id,
        completed: realStatus,
      };
      console.log(dataSend);
      fetch("http://localhost/todos/?toggle=" + id, {
        method: "POST",
        body: JSON.stringify(dataSend),
      })
        .then((response) => response.json())
        .then((dataResponse) => {
          console.log(dataResponse);
          window.location.href = "../todoList";
        });
    },
  },
};
</script>

<style>
.btn {
  margin-right: 5px;
  border-radius: 10px;
}

.completed {
  text-decoration: line-through;
  color: grey;
}
</style>