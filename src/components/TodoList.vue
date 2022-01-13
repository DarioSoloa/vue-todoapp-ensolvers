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
                  {{ todo.name }}
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
import axios from "axios";

export default {
  data() {
    return {
      todos: [],
    };
  },
  created: function () {
    this.getAllTodos();
  },
  methods: {
    getAllTodos() {
      axios
        .get("http://localhost:3000/api/todo/")
        .then((response) => {
          this.todos = response.data;
        })
        .catch((e) => console.log(e));
    },
    removeTodo(id) {
      axios
        .delete("http://localhost:3000/api/todo/" + id)
        .then((response) => {
          console.log(response);
        })
        .catch((e) => console.log(e));
      window.location.href = "todoList";
    },
    changeStatus(id, status) {
      if (status == false) {
        var realStatus = true;
      } else if (status == true) {
        realStatus = false;
      }
      axios
        .put("http://localhost:3000/api/todo/" + id, {
          completed: realStatus,
        })
        .then((response) => {
          console.log(response);
        })
        .catch((e) => console.log(e));
      window.location.href = "todoList";
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