import React from "react";
import { SidebarProvider } from "@/components/ui/sidebar";
import { AppSidebar } from "@/components/app-sidebar";
import { SidebarInset } from "@/components/ui/sidebar";
import { SiteHeader } from "@/components/site-header";
import { usePage } from "@inertiajs/react";
import DynamicDataTable from "@/components/DynamicDataTable";

export default function Bookings() {
    const { bookings } = usePage().props;

    const flattenedBookings = bookings.map((b) => {
        let statusBadge = "bg-gray-200 text-gray-800";
        if (b.status === "confirmed") statusBadge = "bg-green-200 text-green-800";
        else if (b.status === "pending") statusBadge = "bg-yellow-200 text-yellow-800";
        else if (b.status === "cancelled") statusBadge = "bg-red-200 text-red-800";

        return {
            id: b.id,
            guest_name: b.guest?.name || "N/A",
            guest_email: b.guest?.email || "N/A",
            property_title: b.property?.title || "N/A",
            check_in: b.check_in,
            check_out: b.check_out,
            total_price: `${b.total_price} MAD`,
            status: (
                <span className={`px-2 py-1 rounded-full text-sm ${statusBadge}`}>
                    {b.status}
                </span>
            ),
        };
    });

    const columns = flattenedBookings.length ? Object.keys(flattenedBookings[0]) : [];

    const columnLabels = {
        id: "ID",
        guest_name: "Guest Name",
        guest_email: "Guest Email",
        property_title: "Property",
        check_in: "Check-in",
        check_out: "Check-out",
        total_price: "Total Price",
        status: "Status",
    };

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
                            editRoute="/bookings"
                            deleteRoute="/bookings"
                            columnLabels={columnLabels}
                        />
                    </div>
                </div>
            </SidebarInset>
        </SidebarProvider>
    );
}
