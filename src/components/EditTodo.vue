<template>
  <div class="container">
    <div class="card">
      <div class="card-header">Editting Task "{{ todo.name }}"</div>
      <div class="card-body">
        <form v-on:submit.prevent="updateTodo">
          <div class="form-group">
            <label for="name">Title</label>
            <input
              type="text"
              class="form-control"
              name="name"
              id="name"
              required
              v-model="todo.name"
              aria-describedby="helpId"
              placeholder="Title"
            />
            <small id="helpId" class="form-text text-muted"
              >What needs to be done</small
            >
          </div>
          <div class="btn-group" role="group" aria-label="">
            <button type="submit" class="btn btn-success">Update</button>
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
  created: function () {
    this.getTodoById();
  },
  methods: {
    getTodoById() {
      axios
        .get("http://localhost:3000/api/todo/" + this.$route.params.id)
        .then((response) => {
          this.todo = response.data;
        })
        .catch((e) => console.log(e));
    },
    updateTodo() {
      axios
        .put("http://localhost:3000/api/todo/" + this.$route.params.id, {
          name: this.todo.name,
        })
        .then((response) => {
          console.log(response);
        })
        .catch((e) => console.log(e));
      window.location.href = "../todoList";
    },
  },
};
</script>