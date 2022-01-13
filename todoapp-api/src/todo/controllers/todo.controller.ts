import { Controller, Get, Param, Post, Body, Put, Delete } from '@nestjs/common';
import { TodoService } from './../services/todo.service';

@Controller('api/todo')
export class TodoController {

    constructor(
        private todoService: TodoService
    ) { }

    @Get()
    getAll() {
        return this.todoService.findAll();
    }

    @Get(':id')
    getOne(@Param('id') id: number) {
        return this.todoService.findOne(id);
    }

    @Post()
    create(@Body() body: any) {
        return this.todoService.create(body);
    }

    @Put(':id')
    update(@Param('id') id: number, @Body() body: any) {
        return this.todoService.update(id, body);
    }

    @Delete(':id')
    delete(@Param('id') id: number) {
        return this.todoService.delete(id);
    }
}
