import React from "react";
import { SidebarProvider } from "@/components/ui/sidebar";
import { AppSidebar } from "@/components/app-sidebar";
import { SidebarInset } from "@/components/ui/sidebar";
import { SiteHeader } from "@/components/site-header";
import { usePage } from "@inertiajs/react";
import DynamicDataTable from "@/components/DynamicDataTable";

export default function Amenities() {
    const { amenities } = usePage().props; // Data from DB

    // Auto-detect columns dynamically
    const columns = amenities.length ? Object.keys(amenities[0]) : [];

    return (
        <SidebarProvider>
            <AppSidebar variant="inset" />
            <SidebarInset>
                <SiteHeader />
                <div className="p-6">
                    <h1 className="text-2xl font-semibold mb-4">Amenities</h1>
                    <p className="text-slate-600 mb-6">
                        Here you can manage all amenities.
                    </p>
                    <div className="@container/main flex flex-1 flex-col gap-2">
                        <div className="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
                            <DynamicDataTable
                                data={amenities}
                                columns={columns}
                                editRoute="/admin/amenities"
                                deleteRoute="/admin/amenities"
                            />
                        </div>
                    </div>
                </div>
            </SidebarInset>
        </SidebarProvider>
    );
}
