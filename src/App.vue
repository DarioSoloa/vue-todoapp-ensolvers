<template>
  <nav class="navbar navbar-expand navbar-light bg-light">
    <div class="nav navbar-nav">
      <img class="logo" src=".\assets\logo.png" />
      <router-link to="/addTodo" class="nav-link">Add new To-do</router-link>
      <router-link to="/todoList" class="nav-link">To-do list</router-link>
    </div>
  </nav>
  <br />
  <router-view />
</template>

<style>
* {
  padding: 0px;
  margin: 0px;
}
.logo {
  max-height: 10%;
  max-width: 10%;
}

.nav-link {
  justify-content: center;
  align-items: center;
  display: flex;
  font-size: 20px;
}
</style>
