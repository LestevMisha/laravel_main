document.addEventListener("DOMContentLoaded", function () {

    // GLOBAL
    let scene, camera, renderer, controls, gltfObject, clock;
    const anchorElement = document.getElementById("anchor");
    // init
    function init() {
        scene = new THREE.Scene();
        camera = new THREE.PerspectiveCamera(75, anchorElement.getBoundingClientRect().width / anchorElement.getBoundingClientRect().height, 0.1, 1000);
        renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
        controls = new THREE.OrbitControls(camera, renderer.domElement);
        clock = new THREE.Clock();
        // renderer settings
        renderer.setClearColor(0x000000, 0);
        renderer.setSize(anchorElement.getBoundingClientRect().width, anchorElement.getBoundingClientRect().height);
        // camera settings
        camera.position.set(1, 0, 0);
        camera.lookAt(0, 0, 0); // camera looks at the boom's zero

        // controls orbit settings
        controls.minDistance = 9;
        controls.enableZoom = false; // Disable zooming
        controls.minPolarAngle = Math.PI / 2;
        controls.maxPolarAngle = Math.PI / 2;
        controls.update();

        // elements
        // const axesHelper = new THREE.AxesHelper(5);
        // scene.add(axesHelper);

        var pivot = new THREE.Group();
        const loader = new THREE.GLTFLoader().setPath('3D/NikeAirMag/');
        loader.load('NikeAirMag-scene.gltf', function (gltf) {
            gltfObject = gltf.scene;
            gltf.scene.scale.set(8.0, 8.0, 8.0);
            gltfObject.position.z = -4;
            pivot.rotateY(-0.5);

            scene.add(pivot);
            pivot.add(gltfObject);
        });
        const light = new THREE.AmbientLight(0x0d6efd); // soft white light
        scene.add(light);
        const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
        scene.add(directionalLight);
        const directionalLight2 = new THREE.DirectionalLight(0x0d6efd, 1);
        scene.add(directionalLight2);

        

        // animate
        function animate(time) {

            // Rotate the loaded object
            if (gltfObject) {
                const time = clock.getElapsedTime();

                gltfObject.position.y = Math.cos(time) * 0.1;
                pivot.rotateY(Math.cos(time) * (-0.001));
            }

            renderer.render(scene, camera);
            composer.render();
        }

        // finish up
        const composer = new THREE.EffectComposer(renderer);

        const renderPass = new THREE.RenderPass(scene, camera);
        composer.addPass(renderPass);

        const glitchPass = new THREE.FilmPass(
            0.35, // noise intensity
            0.6, // scanline intensity
            2048, // scanline count
            false, // grayscale
        );
        composer.addPass(glitchPass);

        anchorElement.appendChild(renderer.domElement);
        renderer.setAnimationLoop(animate);
    }

    init();

    function onWindowResize() {
        camera.aspect = anchorElement.getBoundingClientRect().width / anchorElement.getBoundingClientRect().height;
        camera.updateProjectionMatrix();
        renderer.setSize(anchorElement.getBoundingClientRect().width, anchorElement.getBoundingClientRect().height);
    }
    window.addEventListener("resize", onWindowResize, false);

    // let scene, camera, renderer, cube, loader;
    // let gltfObject;
    // const anchor = document.getElementById("anchor");
    // const anchorElement.getBoundingClientRect().width = anchor.getBoundingClientRect().anchorElement.getBoundingClientRect().width;
    // const anchorElement.getBoundingClientRect().height = anchor.getBoundingClientRect().anchorElement.getBoundingClientRect().height;

    // function init() {
    //     scene = new THREE.Scene();
    //     camera = new THREE.PerspectiveCamera(95, anchorElement.getBoundingClientRect().width / anchorElement.getBoundingClientRect().height, 0.1, 1000);
    //     renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    //     renderer.setSize(anchorElement.getBoundingClientRect().width, anchorElement.getBoundingClientRect().height);
    //     renderer.setClearColor(0x000000, 0)

    //     anchor.appendChild(renderer.domElement);

    //     loader = new THREE.GLTFLoader();
    //     loader.load(
    //         // resource URL
    //         '3D/scene.gltf',
    //         // called when the resource is loaded
    //         function (gltf) {
    //             gltfObject = gltf.scene;
    //             scene.add(gltfObject);

    //             // Traverse through the object and set emissive material
    //             gltfObject.traverse(child => {
    //                 if (child.isMesh) {
    //                     child.material.emissive.set(0xffffff); // Set emissive color to white
    //                     child.material.emissiveIntensity = 1; // Set emissive intensity
    //                 }
    //             });

    //             gltf.animations; // Array<THREE.AnimationClip>
    //             gltf.scene; // THREE.Group
    //             gltf.scenes; // Array<THREE.Group>
    //             gltf.cameras; // Array<THREE.Camera>
    //             gltf.asset; // Object
    //         },
    //         // called while loading is progressing
    //         function (xhr) {
    //             console.log((xhr.loaded / xhr.total * 100) + '% loaded');
    //         },
    //         // called when loading has errors
    //         function (error) {
    //             console.log('An error happened');
    //         }
    //     );

    //     camera.position.z = 1;

    //     const light = new THREE.AmbientLight(0xffffff); // soft white light
    //     scene.add(light);
    //     const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
    //     scene.add(directionalLight);
    //     // const directionalLight2 = new THREE.DirectionalLight(0x0d6efd, 1);
    //     // scene.add(directionalLight2);
    // }

    // function animate() {
    //     requestAnimationFrame(animate);

    //     // Rotate the loaded object
    //     if (gltfObject) {
    //         // gltfObject.rotation.x += 0.007;
    //         // gltfObject.rotateY(0.003);
    //     }

    //     renderer.render(scene, camera);
    //     // composer.render();
    // }

    // init();
    // const controls = new THREE.OrbitControls(camera, renderer.domElement);
    // controls.autoRotate = true

    // const composer = new THREE.EffectComposer(renderer);
    // const renderPass = new THREE.RenderPass(scene, camera);
    // composer.addPass(renderPass);

    // // const bloomPass = new THREE.UnrealBloomPass(new THREE.Vector2(anchorElement.getBoundingClientRect().width, anchorElement.getBoundingClientRect().height), 1, 0.2, 0.1);
    // // console.log(bloomPass)

    // // composer.addPass(bloomPass);

    // animate();

});