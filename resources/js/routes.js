import CustomersPage from './pages/CustomersPage'
import SuppliersPage from './pages/SuppliersPage'
import ProductsPage from './pages/ProductsPage'
import SalesPage from './pages/SalesPage'
import RepairsPage from './pages/RepairsPage'
import BudgetsPage from './pages/BudgetsPage'
import VehicleBrandsPage from './pages/VehicleBrandsPage'
import Vehicles from './pages/VehiclesPage'
import ProductBrandPage from './pages/ProductBrandPage'

export default [
    { name: 'home', path: '/' },
    { name: 'customers', path: '/clientes', component: CustomersPage },
    { name: 'suppliers', path: '/proveedores', component: SuppliersPage },
    { name: 'products', path: '/productos', component: ProductsPage },
    { name: 'sales', path: '/ventas', component: SalesPage },
    { name: 'repairs', path: '/reparaciones', component: RepairsPage },
    { name: 'budgets', path: '/presupuestos', component: BudgetsPage },
    { name: 'vehicle_brands', path: '/marcas-de-vehiculos', component: VehicleBrandsPage },
    { name: 'vehicles', path: '/vehiculos', component: Vehicles },
    { name: 'product_brands', path: '/marca-de-productos', component: ProductBrandPage },
]