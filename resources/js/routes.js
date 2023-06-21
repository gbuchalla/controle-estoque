// Auth Components
const Login = require('./components/auth/Login.vue').default;
const Register = require('./components/auth/Register.vue').default;
const Logout = require('./components/auth/Logout.vue').default;
// import Register from './components/auth/Register.vue'; // sintaxe opcional

// Home Component
const Home = require('./components/Home.vue').default;

// Employee Components
const EmployeesCreate = require('./components/Employees/Create.vue').default;
const Employees = require('./components/Employees/Index.vue').default;

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
let PaidSalaries = require('./components/Salary/All_Employees.vue').default;
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
    { path: '/login', component: Login, name: 'login' },
    { path: '/register', component: Register, name: 'register' },
    { path: '/logout', component: Logout, name: 'logout' },

    { path: '/', component: Home, name: 'home' },
    
    // Employee Routes
    { path: '/employees', name: Employees, name: 'employees' },
    { path: '/employees/create', name: EmployeesCreate, name: 'employees-create' },
    { path: '/employees/edit/:id', component: EmployeesEdit, name: 'employees-edit' },

    // Supplier Routes
    { path: '/store-supplier', component: SuppliersCreate, name: 'suppliers-create' },
    { path: '/supplier', component: Suppliers, name: 'suppliers' },
    { path: '/edit-supplier/:id', component: SuppliersEdit, name: 'suppliers-edit' },

    // Category Routes
    { path: '/store-category', component: CategoriesCreate, name: 'categories-create' },
    { path: '/category', component: Categories, name: 'categories' },
    { path: '/edit-category/:id', component: CategoriesEdit, name: 'categories-edit' },

    // Product Routes
    { path: '/store-product', component: ProductsCreate, name: 'products-create' },
    { path: '/product', component: Products, name: 'products' },
    { path: '/edit-product/:id', component: ProductsEdit, name: 'products-edit' },

    // Expense Routes
    { path: '/store-expense', component: ExpensesCreate, name: 'expenses-create' },
    { path: '/expense', component: Expenses, name: 'expenses' },
    { path: '/edit-expense/:id', component: ExpensesEdit, name: 'expenses-edit' },

    
    // TODO: Change salary routes and components naming later**  
    // Salary Routes 
    { path: '/paid-salaries', component: PaidSalaries, name: 'salaries-paid' },
    { path: '/pay-salary/:id', component: SalariesPay, name: 'salaries-pay' },

    { path: '/salaries', component: SalariesAll, name: 'salaries' },
    { path: '/show-salary/:id', component: SalariesShow, name: 'salaries-show' },
    { path: '/edit-salary/:id', component: SalariesEdit, name: 'salaries-edit' },

    // Stock Routes
    { path: '/stock', component: stock, name: 'stock' },
    { path: '/edit-stock/:id', component: editstock, name: 'stock-edit' },

    // Customer Routes
    { path: '/store-customer', component: CustomersCreate, name: 'customers-create' },
    { path: '/customer', component: Customers, name: 'customers' },
    { path: '/edit-customer/:id', component: CustomersEdit, name: 'customers-edit' },

    { path: '/:pathMatch(.*)*', name: 'NotFound', redirect: '/' }
];
