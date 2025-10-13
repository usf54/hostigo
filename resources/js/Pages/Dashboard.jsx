import { AppSidebar } from "@/components/app-sidebar"
import { ChartAreaInteractive } from "@/components/chart-area-interactive"
import { DataTable } from "@/components/data-table"
import { SectionCards } from "@/components/section-cards"
import { SiteHeader } from "@/components/site-header"
import { SidebarInset, SidebarProvider } from "@/components/ui/sidebar"

import DynamicDataTable from "@/components/DynamicDataTable"

export default function Page({ latestUsers, totalRevenue, totalPaymentThisWeek, totalAdminsThisMonth, totalCustomersThisMonth, totalHostsThisMonth, totalGuestsThisMonth}) {
  
  return (
    <SidebarProvider>
      <AppSidebar variant="inset" />
      <SidebarInset>
        <SiteHeader />
        <div className="flex flex-1 flex-col">
          <div className="@container/main flex flex-1 flex-col gap-2">
            <div className="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
              <SectionCards 
                totalRevenue={totalRevenue}
                totalPaymentThisWeek={totalPaymentThisWeek}
                totalAdminsThisMonth={totalAdminsThisMonth}
                totalCustomersThisMonth={totalCustomersThisMonth}
                totalHostsThisMonth={totalHostsThisMonth}
                totalGuestsThisMonth={totalGuestsThisMonth}/>
              <div className="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
                <h1 className="text-2xl font-semibold mb-4  ml-5">Latest Users</h1>
                <DynamicDataTable
                  data={latestUsers}
                  columns={["id", "name", "email", "role", "created_at"]}
                  editRoute="/users"
                  deleteRoute="/users"
                  />
              </div>
            </div>
          </div>
        </div>
      </SidebarInset>
    </SidebarProvider>
  );
}
