import CustomersPage from './pages/CustomersPage'
import SuppliersPage from './pages/SuppliersPage'
import ProductsPage from './pages/ProductsPage'
import SalesPage from './pages/SalesPage'
import RepairsPage from './pages/RepairsPage'
import BudgetsPage from './pages/BudgetsPage'
import VehicleBrandsPage from './pages/VehicleBrandsPage'
import Vehicles from './pages/VehiclesPage'
import ProductBrandPage from './pages/ProductBrandPage'
import VehiclesPage from './pages/VehiclesPage'
import SupplierPaymentsPage from './pages/SupplierPaymentsPage'
import CustomerPaymentsPage from './pages/CustomerPaymentsPage'
import CustomerReturnsPage from './pages/CustomerReturnsPage'
import SupplierReturnsPage from './pages/SupplierReturnsPage'

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
    { name: 'vehicles', path: '/vehiculos', component: VehiclesPage },
    { name: 'supplier_payments', path: '/pagos-a-proveedores', component: SupplierPaymentsPage },
    { name: 'customer_payments', path: '/pagos-de-clientes', component: CustomerPaymentsPage },
    { name: 'customer_returns', path: '/devoluciones-de-clientes', component: CustomerReturnsPage },
    { name: 'supplier_returns', path: '/devoluciones-a-proveedores', component: SupplierReturnsPage },
]