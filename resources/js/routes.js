import CustomersPage from './pages/CustomersPage'
import SuppliersPage from './pages/SuppliersPage'
import ProductsPage from './pages/ProductsPage'
import SalesPage from './pages/SalesPage'
import BudgetsPage from './pages/BudgetsPage'
import VehicleBrandPage from './pages/VehicleBrandPage'
import Vehicles from './pages/VehiclesPage'

export default [
    { name: 'home', path: '/' },
    { name: 'customers', path: '/clientes', component: CustomersPage },
    { name: 'suppliers', path: '/proveedores', component: SuppliersPage },
    { name: 'products', path: '/productos', component: ProductsPage },
    { name: 'sales', path: '/ventas', component: SalesPage },
    { name: 'budgets', path: '/presupuestos', component: BudgetsPage },
    { name: 'vehicle_brands', path: '/marcaVehiculos', component: VehicleBrandPage },
    { name: 'vehicles', path: '/Vehiculos', component: Vehicles },
]