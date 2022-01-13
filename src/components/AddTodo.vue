<template>
  <div class="container">
    <div class="card">
      <div class="card-header">Add a new To-do</div>
      <div class="card-body">
        <form v-on:submit.prevent="addTodo">
          <div class="form-group">
            <label for="nombre">Title</label>
            <input
              type="text"
              class="form-control"
              name="name"
              id="name"
              required
              v-model="todo.name"
              aria-describedby="helpId"
            />
            <small id="helpId" class="form-text text-muted"
              >What needs to be done</small
            >
          </div>
          <div class="btn-group" role="group" aria-label="">
            <button type="submit" class="btn btn-success">Add</button>
            <router-link :to="{ name: 'TodoList' }" class="btn btn-warning"
              >Cancel</router-link
            >
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      todo: {},
    };
  },
  methods: {
    addTodo() {
      axios
        .post("http://localhost:3000/api/todo/", {
          name: this.todo.name,
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