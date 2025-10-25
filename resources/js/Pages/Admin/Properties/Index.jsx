import React from "react";
import { SidebarProvider } from "@/components/ui/sidebar";
import { AppSidebar } from "@/components/app-sidebar";
import { SidebarInset } from "@/components/ui/sidebar";
import { SiteHeader } from "@/components/site-header";
import { usePage, router } from "@inertiajs/react";
import DynamicDataTable from "@/components/DynamicDataTable";

export default function Properties() {
    const { properties } = usePage().props;

    // Flatten relational data and render images as thumbnails
    const flattenedProperties = properties.map((p) => ({
        id: p.id,
        title: p.title,
        host_name: p.host?.name || "N/A",
        city: p.city || "N/A",
        country: p.country || "N/A",
        price_per_night: p.price_per_night,
        max_guests: p.max_guests,
        amenities: p.amenities?.map(a => a.name).join(", ") || "N/A",
        images: (
            <div className="flex gap-2">
                {p.images?.map((img) => (
                    <img
                        key={img.id}
                        src={img.image_url.startsWith("http") ? img.image_url : `/storage/${img.image_url}`}
                        alt={p.title}
                        className="w-12 h-12 object-cover rounded-md border"
                    />
                ))}
            </div>
        ),
        created_at: p.created_at,
    }));

    const columns = flattenedProperties.length ? Object.keys(flattenedProperties[0]) : [];

    const columnLabels = {
        id: "ID",
        title: "Title",
        host_name: "Host",
        city: "City",
        country: "Country",
        price_per_night: "Price/Night",
        max_guests: "Max Guests",
        amenities: "Amenities",
        images: "Images",
        created_at: "Created At",
    };

    return (
        <SidebarProvider>
            <AppSidebar variant="inset" />
            <SidebarInset>
                <SiteHeader />
                <div className="p-6">
                    <div className="flex justify-between items-center mb-4">
                        <button
                            onClick={() => router.get("/properties/create")}
                            className="px-4 py-2 bg-blue-600 text-white"
                        >
                            Add Property
                        </button>
                    </div>
                    <h1 className="text-2xl font-semibold mb-4">Properties</h1>
                    <p className="text-slate-600 mb-6">
                        Here you can manage all properties.
                    </p>

                    <div className="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
                        <DynamicDataTable
                            data={flattenedProperties}
                            columns={columns}
                            showRoute="/properties"
                            editRoute="/properties"
                            deleteRoute="/properties"
                            columnLabels={columnLabels}
                        />
                    </div>
                </div>
            </SidebarInset>
        </SidebarProvider>
    );
}
