"use strict";
class Employee {
    constructor(id, name, address) {
        this.address = address;
        this.id = id;
        this.name = name;
    }
    getNameWithAddress() {
        return this.name + " " + this.address;
    }
}
let john = new Employee(1, "John", "Highway 71");
let address = john.getNameWithAddress();
//john.id = 1;
//john.name = 'John';
//john.address = 'Highway 71';
console.log(address);
//In Typescript we can have either default constructor or parametralized constructor but not both in the same program like other programming languages.
