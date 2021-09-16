import CustomersPage from './pages/CustomersPage'
import SuppliersPage from './pages/SuppliersPage'
import ProductsPage from './pages/ProductsPage'
import SalesPage from './pages/SalesPage'
import RepairsPage from './pages/RepairsPage'
import BudgetsPage from './pages/BudgetsPage'
import VehicleBrandsPage from './pages/VehicleBrandsPage'
import VehiclesPage from './pages/VehiclesPage'
import SupplierPaymentsPage from './pages/SupplierPaymentsPage'

export default [
    { name: 'home', path: '/' },
    { name: 'customers', path: '/clientes', component: CustomersPage },
    { name: 'suppliers', path: '/proveedores', component: SuppliersPage },
    { name: 'products', path: '/productos', component: ProductsPage },
    { name: 'sales', path: '/ventas', component: SalesPage },
    { name: 'repairs', path: '/reparaciones', component: RepairsPage },
    { name: 'budgets', path: '/presupuestos', component: BudgetsPage },
    { name: 'vehicle_brands', path: '/marcas-de-vehiculos', component: VehicleBrandsPage },
    { name: 'vehicles', path: '/vehiculos', component: VehiclesPage },
    { name: 'supplier_payments', path: '/pagos-a-proveedores', component: SupplierPaymentsPage },
]