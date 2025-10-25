import React, { useEffect } from "react";
import { SidebarProvider } from "@/components/ui/sidebar";
import { AppSidebar } from "@/components/app-sidebar";
import { SidebarInset } from "@/components/ui/sidebar";
import { SiteHeader } from "@/components/site-header";
import { usePage, router } from "@inertiajs/react";
import DynamicDataTable from "@/components/DynamicDataTable";
import toast, { Toaster } from "react-hot-toast";

export default function Amenities() {
    const { amenities, flash } = usePage().props; 

    useEffect(() => {
        if (flash?.success) toast.success(flash.success);
        if (flash?.error) toast.error(flash.error);
    }, [flash]);

    // Auto-detect columns
    const columns = amenities.length ? Object.keys(amenities[0]) : [];

    return (
        <SidebarProvider>
            <AppSidebar variant="inset" />
            <SidebarInset>
                <SiteHeader />
                <div className="p-6">
                    <div className="flex justify-between mb-3">
                        <button
                            onClick={() => router.get("amenities/create")}
                            className="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700"
                        >
                            + New Amenity
                        </button>
                    </div>

                    <h1 className="text-2xl font-semibold mb-4">Amenities</h1>
                    <p className="text-slate-600 mb-6">
                        Here you can manage all amenities.
                    </p>

                    <div className="@container/main flex flex-1 flex-col gap-2">
                        <div className="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
                            <DynamicDataTable
                                data={amenities}
                                columns={columns}
                                showRoute="/amenities"
                                editRoute="/amenities"
                                deleteRoute="/amenities"
                            />
                        </div>
                    </div>
                </div>
            </SidebarInset>

            <Toaster position="top-right" />
        </SidebarProvider>
    );
}
