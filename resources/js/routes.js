// Auth Components
const Login = require('./components/auth/Login.vue').default;
const Register = require('./components/auth/Register.vue').default;
const Logout = require('./components/auth/Logout.vue').default;
// import Register from './components/auth/Register.vue'; // sintaxe opcional

// Home Component
const Home = require('./components/Home.vue').default;

// Employee Components
let EmployeesCreate = require('./components/Employee/Create.vue').default;
let Employees = require('./components/Employee/Index.vue').default;
let EmployeesEdit = require('./components/Employee/Edit.vue').default;

// Supplier Components
let SuppliersCreate = require('./components/Supplier/Create.vue').default;
let Suppliers = require('./components/Supplier/Index.vue').default;
let SuppliersEdit = require('./components/Supplier/Edit.vue').default;

// Category Components
let CategoriesCreate = require('./components/Category/Create.vue').default;
let Categories = require('./components/Category/Index.vue').default;
let CategoriesEdit = require('./components/Category/Edit.vue').default;

// Product Components
let ProductsCreate = require('./components/Product/Create.vue').default;
let Products = require('./components/Product/Index.vue').default;
let ProductsEdit = require('./components/Product/Edit.vue').default;

// Expense Components
let ExpensesCreate = require('./components/Expense/Create.vue').default;
let Expenses = require('./components/Expense/expense.vue').default;
let ExpensesEdit = require('./components/Expense/Edit.vue').default;

// Salary Components
let EmployeesSalaries = require('./components/Salary/All_Employees.vue').default;
let SalariesPay = require('./components/Salary/Create.vue').default;

let SalariesAll = require('./components/Salary/Index.vue').default;
let SalariesShow = require('./components/Salary/Show.vue').default;
let SalariesEdit = require('./components/Salary/Edit.vue').default;

// Stock Components
let Stock = require('./components/Product/Stock.vue').default;
let StockEdit = require('./components/Product/Edit_Stock.vue').default;

// Customer Components  
let CustomersCreate = require('./components/Customer/Create.vue').default;
let Customers = require('./components/Customer/Index.vue').default;
let CustomersEdit = require('./components/Customer/Edit.vue').default;



export const routes = [

    // Auth Routes
    { path: '/login', component: Login, name: 'login' },
    { path: '/register', component: Register, name: 'register' },
    { path: '/logout', component: Logout, name: 'logout' },

    // Home Route
    { path: '/', component: Home, name: 'home' },
    
    // Employee Routes
    { path: '/employees/create', component: EmployeesCreate, name: 'employees-create' },
    { path: '/employees', component: Employees, name: 'employees' },
    { path: '/employees/:id/edit', component: EmployeesEdit, name: 'employees-edit' },

    // Supplier Routes
    { path: '/suppliers/create', component: SuppliersCreate, name: 'suppliers-create' },
    { path: '/suppliers', component: Suppliers, name: 'suppliers' },
    { path: '/suppliers/:id/edit', component: SuppliersEdit, name: 'suppliers-edit' },

    // Category Routes
    { path: '/categories/create', component: CategoriesCreate, name: 'categories-create' },
    { path: '/categories', component: Categories, name: 'categories' },
    { path: '/categories/:id/edit', component: CategoriesEdit, name: 'categories-edit' },

    // Product Routes
    { path: '/products/create', component: ProductsCreate, name: 'products-create' },
    { path: '/products', component: Products, name: 'products' },
    { path: '/products/:id/edit', component: ProductsEdit, name: 'products-edit' },

    // Expense Routes
    { path: '/expenses/create', component: ExpensesCreate, name: 'expenses-create' },
    { path: '/expenses', component: Expenses, name: 'expenses' },
    { path: '/expenses/:id/edit', component: ExpensesEdit, name: 'expenses-edit' },

    // Salary Routes 
    { path: '/salaries/employees', component: EmployeesSalaries, name: 'employees-salaries' },
    { path: '/salaries/:employee_id/pay', component: SalariesPay, name: 'salaries-pay' },
    { path: '/salaries', component: SalariesAll, name: 'salaries' },
    { path: '/salaries/:id/show', component: SalariesShow, name: 'salaries-show' },
    { path: '/salaries/:id/edit', component: SalariesEdit, name: 'salaries-edit' },

    // Stock Routes
    { path: '/stock', component: Stock, name: 'stock' },
    { path: '/stock/:id/edit', component: StockEdit, name: 'stock-edit' },

    // Customer Routes
    { path: '/customers/create', component: CustomersCreate, name: 'customers-create' },
    { path: '/customers', component: Customers, name: 'customers' },
    { path: '/customers/:id/edit', component: CustomersEdit, name: 'customers-edit' },

    { path: '/:pathMatch(.*)*', name: 'NotFound', redirect: '/' }
];
