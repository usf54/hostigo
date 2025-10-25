import React from "react";
import { SidebarProvider } from "@/components/ui/sidebar";
import { AppSidebar } from "@/components/app-sidebar";
import { SidebarInset } from "@/components/ui/sidebar";
import { SiteHeader } from "@/components/site-header";
import { usePage, router } from "@inertiajs/react";

export default function ShowProperty() {
    const { property } = usePage().props;

    if (!property) {
        return (
            <div className="p-6 text-center text-gray-500">
                Property details not available.
            </div>
        );
    }

    const {
        id,
        title,
        description,
        price_per_night,
        max_guests,
        address,
        city,
        country,
        latitude,
        longitude,
        host,
        amenities,
        images,
        created_at,
    } = property;

    return (
        <SidebarProvider>
            <AppSidebar variant="inset" />
            <SidebarInset>
                <SiteHeader />
                <div className="p-6">
                    {/* Header */}
                    <div className="flex justify-between items-center mb-6">
                        <h1 className="text-3xl font-bold text-gray-800">{title}</h1>
                        <button
                            onClick={() => router.get("/properties")}
                            className="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 text-sm"
                        >
                            ← Back
                        </button>
                    </div>

                    {/* Main Container */}
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {/* Left: Images */}
                        <div className="md:col-span-1">
                            <h2 className="text-lg font-semibold text-gray-700 mb-2">Images</h2>
                            {images && images.length > 0 ? (
                                <div className="flex flex-col gap-2">
                                    {images.map((img) => (
                                        <img
                                            key={img.id}
                                            src={
                                                img.image_url.startsWith("http")
                                                    ? img.image_url
                                                    : `/storage/${img.image_url}`
                                            }
                                            alt={title}
                                            className="w-full h-48 object-cover rounded-md border"
                                        />
                                    ))}
                                </div>
                            ) : (
                                <p className="text-gray-500 text-sm">No images available.</p>
                            )}
                        </div>

                        {/* Right: Details */}
                        <div className="md:col-span-2 space-y-6">
                            {/* Host */}
                            <div className="bg-white shadow rounded-lg p-4">
                                <h3 className="font-semibold text-gray-700 mb-2">Host</h3>
                                <p className="text-gray-600">{host?.name || "N/A"}</p>
                                <p className="text-gray-600">{host?.email || ""}</p>
                            </div>

                            {/* Description */}
                            {description && (
                                <div className="bg-white shadow rounded-lg p-4">
                                    <h3 className="font-semibold text-gray-700 mb-2">Description</h3>
                                    <p className="text-gray-600">{description}</p>
                                </div>
                            )}

                            {/* General Info */}
                            <div className="bg-white shadow rounded-lg p-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div>
                                    <h4 className="text-sm text-gray-500">Price/Night</h4>
                                    <p className="font-medium">{price_per_night} MAD</p>
                                </div>
                                <div>
                                    <h4 className="text-sm text-gray-500">Max Guests</h4>
                                    <p className="font-medium">{max_guests}</p>
                                </div>
                                <div>
                                    <h4 className="text-sm text-gray-500">Created At</h4>
                                    <p className="font-medium">{new Date(created_at).toLocaleDateString()}</p>
                                </div>
                                <div>
                                    <h4 className="text-sm text-gray-500">Location</h4>
                                    <p className="font-medium">{city}, {country}</p>
                                </div>
                                <div>
                                    <h4 className="text-sm text-gray-500">Address</h4>
                                    <p className="font-medium">{address || "N/A"}</p>
                                </div>
                                <div>
                                    <h4 className="text-sm text-gray-500">Latitude</h4>
                                    <p className="font-medium">{latitude || "N/A"}</p>
                                </div>
                                <div>
                                    <h4 className="text-sm text-gray-500">Longitude</h4>
                                    <p className="font-medium">{longitude || "N/A"}</p>
                                </div>
                            </div>

                            {/* Amenities */}
                            <div className="bg-white shadow rounded-lg p-4">
                                <h3 className="font-semibold text-gray-700 mb-2">Amenities</h3>
                                <div className="flex flex-wrap gap-2">
                                    {amenities && amenities.length > 0 ? (
                                        amenities.map((a) => (
                                            <span
                                                key={a.id}
                                                className="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm"
                                            >
                                                {a.name}
                                            </span>
                                        ))
                                    ) : (
                                        <p className="text-gray-500 text-sm">No amenities listed.</p>
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </SidebarInset>
        </SidebarProvider>
    );
}
