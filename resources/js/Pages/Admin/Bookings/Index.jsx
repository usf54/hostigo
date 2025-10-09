import React from "react";
import { SidebarProvider } from "@/components/ui/sidebar";
import { AppSidebar } from "@/components/app-sidebar";
import { SidebarInset } from "@/components/ui/sidebar";
import { SiteHeader } from "@/components/site-header";
import { usePage } from "@inertiajs/react";
import DynamicDataTable from "@/components/DynamicDataTable";

export default function Bookings() {
    const { bookings } = usePage().props;

    // Flatten relational data for display in the table
    const flattenedBookings = bookings.map((b) => ({
        id: b.id,
        guest_name: b.guest?.name || "N/A",
        guest_email: b.guest?.email || "N/A",
        property_title: b.property?.title || "N/A",
        check_in: b.check_in,
        check_out: b.check_out,
        total_price: b.total_price,
        status: b.status,
    }));

    // Dynamically generate table columns from keys
    const columns = flattenedBookings.length ? Object.keys(flattenedBookings[0]) : [];


    return (
        <SidebarProvider>
            <AppSidebar variant="inset" />
            <SidebarInset>
                <SiteHeader />
                <div className="p-6">
                    <h1 className="text-2xl font-semibold mb-4">Bookings</h1>
                    <p className="text-slate-600 mb-6">
                        Here you can manage all property bookings.
                    </p>

                    <div className="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
                        <DynamicDataTable
                            data={flattenedBookings}
                            columns={columns}
                            editRoute="/admin/bookings"
                            deleteRoute="/admin/bookings"
                        />
                    </div>
                </div>
            </SidebarInset>
        </SidebarProvider>
    );
}
